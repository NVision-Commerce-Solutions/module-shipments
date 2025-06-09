<?php

namespace Commerce365\Shipments\Block;

use Commerce365\Core\Service\GetSalesDocument;
use Commerce365\Core\Service\SalesDocumentInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class ShipmentDetails extends Template
{
    private GetSalesDocument $getSalesDocument;

    public function __construct(
        Context $context,
        GetSalesDocument $getSalesDocuments,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->getSalesDocument = $getSalesDocuments;
    }

    public function getShipment()
    {
        $query = [
            'tableNo' => SalesDocumentInterface::SHIPMENT_TABLE_NO,
            'documentType' => 0,
            'id' => $this->getRequest()->getParam('id')
        ];

        return $this->getSalesDocument->execute($query);
    }

    public function safeGet(array $array, string $key, $default = '')
    {
        return $array[$key] ?? $default;
    }
}
