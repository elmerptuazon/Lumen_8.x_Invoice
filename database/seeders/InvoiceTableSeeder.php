<?php

namespace Database\Seeders;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use DB;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice')->delete();

        $invoices = array(
            ['invoice_number' => '123', 'invoice_date' => '2020-05-20', 'user_id' => '1', 'customer_name' => 'demo', 'product_name' => 'product_demo', 'product_quantity' => '10', 'product_price' => '100.50', 'total_invoice_amount' => '200.50'],
            ['invoice_number' => '345', 'invoice_date' => '2020-06-22', 'user_id' => '1', 'customer_name' => 'demo2', 'product_name' => 'product_demo2', 'product_quantity' => '102', 'product_price' => '300.50', 'total_invoice_amount' => '400.50'],
        );

        foreach ($invoices as $invoice) {
            DB::table('invoice')->insert($invoice);
            // Invoice::create($invoice);
        }
    }
}
