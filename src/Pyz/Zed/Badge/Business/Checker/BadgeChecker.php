<?php

declare(strict_types=1);

namespace Pyz\Zed\Badge\Business\Checker;

use Generated\Shared\Transfer\BadgeCheckCriteriaTransfer;
use Generated\Shared\Transfer\BadgeCollectionTransfer;
use Generated\Shared\Transfer\BadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeCollectionTransfer;
use Generated\Shared\Transfer\CustomerBadgeCriteriaTransfer;
use Generated\Shared\Transfer\CustomerBadgeTransfer;
use Pyz\Zed\Badge\Business\Writer\WriterInterface;
use Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface;

class BadgeChecker
{
    /**
     * @param \Pyz\Zed\Badge\Persistence\BadgeRepositoryInterface $badgeRepository
     * @param array<\Pyz\Zed\Badge\Communication\Plugin\OrdersAmountBadgeTypePlugin> $badgeTypePlugins
     */
    public function __construct(
        private readonly BadgeRepositoryInterface $badgeRepository,
        private readonly array $badgeTypePlugins,
        private readonly WriterInterface $writer,
    ) {
        $test = 1;
    }

    /**
     * @param \Generated\Shared\Transfer\BadgeCheckCriteriaTransfer $badgeCheckCriteriaTransfer
     *
     * @return void
     */
    public function checkBadges(BadgeCheckCriteriaTransfer $badgeCheckCriteriaTransfer): void
    {
        $badgeCollection = $this->badgeRepository->get((new BadgeCriteriaTransfer())->setIsActive(true));
        $customerBadgesCollection = $this->badgeRepository->getCustomerBadges(
            (new CustomerBadgeCriteriaTransfer())->setIdCustomer($badgeCheckCriteriaTransfer->getIdCustomer()),
        );

        $customerBadgeToProcessCollectionTransfer = $this->filterBadgesToProcess(
            $badgeCheckCriteriaTransfer->getIdCustomer(),
            $badgeCollection,
            $customerBadgesCollection,
        );

        $this->checkAndSave($customerBadgeToProcessCollectionTransfer);
    }

    /**
     * @param int $idCustomer
     * @param \Generated\Shared\Transfer\BadgeCollectionTransfer $badgeCollectionTransfer
     * @param \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer $customerBadgeCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer
     */
    private function filterBadgesToProcess(
        int $idCustomer,
        BadgeCollectionTransfer $badgeCollectionTransfer,
        CustomerBadgeCollectionTransfer $customerBadgeCollectionTransfer,
    ): CustomerBadgeCollectionTransfer {
        $customerBadgeToProcessCollectionTransfer = new CustomerBadgeCollectionTransfer();

        $customerBadgeIds = [];
        foreach ($customerBadgeCollectionTransfer->getCustomerBadges() as $customerBadgeTransfer) {
            if ($customerBadgeTransfer->getIsAchieved()) {
                $customerBadgeIds[] = $customerBadgeTransfer->getIdBadge();

                continue;
            }
            $this->updateCustomerBadge($customerBadgeTransfer, $badgeCollectionTransfer);
            $customerBadgeToProcessCollectionTransfer->addCustomerBadge($customerBadgeTransfer);
            $customerBadgeIds[] = $customerBadgeTransfer->getIdBadge();
        }

        foreach ($badgeCollectionTransfer->getBadges() as $badgeTransfer) {
            if (in_array($badgeTransfer->getIdBadge(), $customerBadgeIds)) {
                continue;
            }

            $customerBadgeToProcessCollectionTransfer->addCustomerBadge(
                (new CustomerBadgeTransfer())->setIdBadge($badgeTransfer->getIdBadge())
                    ->setIdCustomer($idCustomer)
                    ->setTitle($badgeTransfer->getTitle())
                    ->setDescription($badgeTransfer->getDescription())
                    ->setImageUrl($badgeTransfer->getImageUrl())
                    ->setIsActive($badgeTransfer->getIsActive())
                    ->setTargetAmount($badgeTransfer->getAmount())
                    ->setType($badgeTransfer->getType())
            );
        }

        return $customerBadgeToProcessCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     * @param \Generated\Shared\Transfer\BadgeCollectionTransfer $badgeCollectionTransfer
     *
     * @return void
     */
    private function updateCustomerBadge(
        CustomerBadgeTransfer $customerBadgeTransfer,
        BadgeCollectionTransfer $badgeCollectionTransfer,
    ): void {
        foreach ($badgeCollectionTransfer->getBadges() as $badgeTransfer) {
            if ($customerBadgeTransfer->getIdBadge() !== $badgeTransfer->getIdBadge()) {
                continue;
            }
            if ($customerBadgeTransfer->getTargetAmount() !== $badgeTransfer->getAmount()) {
                $customerBadgeTransfer->setTargetAmount($badgeTransfer->getAmount());
            }
            if ($customerBadgeTransfer->getTitle() !== $badgeTransfer->getTitle()) {
                $customerBadgeTransfer->setTitle($badgeTransfer->getTitle());
            }
            if ($customerBadgeTransfer->getDescription() !== $badgeTransfer->getDescription()) {
                $customerBadgeTransfer->setDescription($badgeTransfer->getDescription());
            }
            if ($customerBadgeTransfer->getImageUrl() !== $badgeTransfer->getImageUrl()) {
                $customerBadgeTransfer->setImageUrl($badgeTransfer->getImageUrl());
            }
            if ($customerBadgeTransfer->getType() !== $badgeTransfer->getType()) {
                $customerBadgeTransfer->setType($badgeTransfer->getType());
            }
            if ($customerBadgeTransfer->getIsActive() !== $badgeTransfer->getIsActive()) {
                $customerBadgeTransfer->setIsActive($badgeTransfer->getIsActive());
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeCollectionTransfer $customerBadgeToProcessCollectionTransfer
     *
     * @return void
     */
    private function checkAndSave(CustomerBadgeCollectionTransfer $customerBadgeToProcessCollectionTransfer): void
    {
        foreach ($customerBadgeToProcessCollectionTransfer->getCustomerBadges() as $customerBadgeTransfer) {
            $customerBadgeTransfer = $this->processCustomerBadge($customerBadgeTransfer);
            $this->writer->saveCustomerBadge($customerBadgeTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerBadgeTransfer $customerBadgeTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerBadgeTransfer
     */
    private function processCustomerBadge(CustomerBadgeTransfer $customerBadgeTransfer): CustomerBadgeTransfer
    {
        foreach ($this->badgeTypePlugins as $badgeTypePlugin) {
            if ($customerBadgeTransfer->getType() !== $badgeTypePlugin->getName()) {
                continue;
            }

            return $badgeTypePlugin->checkCustomerBadge($customerBadgeTransfer);
        }

        return $customerBadgeTransfer;
    }
}
