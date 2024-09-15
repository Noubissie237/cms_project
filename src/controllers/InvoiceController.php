<?php

require_once __DIR__ . '/../models/Invoice.php';

class InvoiceController
{
    private $invoice;

    public function __construct($pdo)
    {
        $this->invoice = new Invoice($pdo);
    }

    public function listInvoices()
    {
        $invoices = $this->invoice->getAllInvoices();
        require __DIR__ . '/../views/invoices/list.php';
    }

    public function showCreateForm()
    {
        require __DIR__ . '/../views/invoices/create.php';
    }

    public function createInvoice($client_id, $amount, $date)
    {
        if (empty($client_id) || empty($amount) || empty($date)) {
            die('Tous les champs sont obligatoires.');
        }

        $this->invoice->addInvoice($client_id, $amount, $date);
        header('Location: /cms_project/public/invoices/');
    }

    public function editInvoiceForm($id)
    {
        $invoice = $this->invoice->getInvoiceById($id);
        require __DIR__ . '/../views/invoices/edit.php';
    }

    public function updateInvoice($id, $client_id, $amount, $date)
    {
        if ($this->invoice->updateInvoice($id, $client_id, $amount, $date)) {
            header('Location: /cms_project/public/invoices/');
            exit();
        } else {
            echo "Erreur lors de la modification de la facture.";
        }
    }

    public function deleteInvoice($id)
    {
        if ($this->invoice->deleteInvoiceById($id)) {
            header('Location: /cms_project/public/invoices/');
            exit();
        } else {
            echo "Erreur lors de la suppression de la facture.";
        }
    }
}
