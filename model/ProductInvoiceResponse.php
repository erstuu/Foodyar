<?php

require_once __DIR__ . "/../domain/Invoice.php";

class ProductInvoiceResponse
{
    public Invoice $invoice;
}