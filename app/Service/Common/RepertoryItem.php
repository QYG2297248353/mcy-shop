<?php
declare (strict_types=1);

namespace App\Service\Common;


use App\Entity\Repertory\CreateItem;
use App\Entity\Repertory\CreateSku;
use App\Entity\Repertory\Markup;
use App\Model\RepertoryItemSku;
use Hyperf\Database\Model\Collection;
use Kernel\Annotation\Bind;

#[Bind(class: \App\Service\Common\Bind\RepertoryItem::class)]
interface RepertoryItem
{

    /**
     * @param int|null $userId
     * @param int $markupTemplateId
     * @param int $categoryId
     * @param int $configId
     * @param int $refundMode
     * @param int $autoReceiptTime
     * @param array $items
     * @param bool $imageDownloadLocal
     * @return array
     */
    public function import(?int $userId, int $markupTemplateId, int $categoryId, int $configId, int $refundMode, int $autoReceiptTime, array $items, bool $imageDownloadLocal): array;

    /**
     * @param CreateItem $createItem
     * @return \App\Entity\Repertory\RepertoryItem
     */
    public function create(CreateItem $createItem): \App\Entity\Repertory\RepertoryItem;

    /**
     * @param int|null $userId
     * @param int $itemId
     * @param CreateSku $sku
     * @param Markup $markup
     * @return RepertoryItemSku
     */
    public function createSku(?int $userId, int $itemId, CreateSku $sku, Markup $markup): \App\Model\RepertoryItemSku;


    /**
     * @param int|\App\Model\RepertoryItem $item
     * @return Markup
     */
    public function getMarkup(int|\App\Model\RepertoryItem $item): Markup;


    /**
     * @param \App\Model\RepertoryItem $repertoryItem
     * @return void
     */
    public function syncRemoteItem(\App\Model\RepertoryItem $repertoryItem): void;

    /**
     * @param \App\Model\RepertoryItem|int $repertoryItem
     * @return void
     */
    public function forceSyncRemoteItemPrice(\App\Model\RepertoryItem|int $repertoryItem): void;

    /**
     * @param bool $isOnlyId
     * @param int|null $userId
     * @param int $second
     * @return array|Collection
     */
    public function getSyncRemoteItems(bool $isOnlyId = true, ?int $userId = null, int $second = 120): array|Collection;
}