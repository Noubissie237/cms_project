<?php

require_once __DIR__ . '/../../config/database.php';

class Invoice
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllInvoices()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM invoices");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addInvoice($client_id, $amount, $date)
    {
        $stmt = $this->pdo->prepare("INSERT INTO invoices (client_id, amount, date) VALUES (?, ?, ?)");
        return $stmt->execute([$client_id, $amount, $date]);
    }

    public function deleteInvoiceById($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM invoices WHERE `invoices`.`id` = $id");
        return $stmt->execute();
    }

    public function getInvoiceById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE id=$id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateInvoice($id, $client_id, $amount, $date)
    {
        $stmt = $this->pdo->prepare("UPDATE `invoices` SET `client_id` = ?, `amount` = ?, `date` = ? WHERE `invoices`.`id` = $id");
        return $stmt->execute([$client_id, $amount, $date]);
    }
}
