<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['sale_m']);
        check_not_login();
    }

    public function sale_report()
    {
        $this->load->model('sale_m');
        $data['sale'] = $this->sale_m->get_sale()->result();
        // var_dump($data['sale']);
        $this->template->load('template', 'reports/sale_report', $data);
    }

    public function stock_report()
    {
        $this->load->model('Item_m');
        $data['items'] = $this->Item_m->get()->result();
        $this->template->load('template', 'reports/stock_report', $data);
    }

    public function detail()
    {
        $sale_id = $this->input->post('sale_id');
        $data = $this->sale_m->get_sale_detail($sale_id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function export_excel()
    {
        $this->load->model('sale_m');
        $sales = $this->sale_m->get_sale()->result();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="sale_report.xls"');
        echo "No.\tInvoice\tTanggal & Waktu\tKasir\tPelanggan\tHarga modal\tHarga jual\tTotal Bayar\tkeuntungan\n";
        $no = 1;
        $total_penjualan = 0;
        $total_keuntungan = 0;
        $jumlah_transaksi = 0;
        foreach ($sales as $s) {
            $customer = $s->customer_name != null ? $s->customer_name : "Umum";
            $harga_modal = isset($s->cost) ? $s->cost : 0;
            $harga_jual = isset($s->final_price) ? $s->final_price : 0;
            $total_bayar = $harga_jual;
            $keuntungan = $harga_jual - $harga_modal;
            $tanggal_waktu = isset($s->date) ? $s->date : '';
            $kasir = isset($s->user_name) ? $s->user_name : '';
            echo $no."\t".$s->invoice."\t".$tanggal_waktu."\t".$kasir."\t".$customer."\tRp ".number_format($harga_modal, 0, ',', '.')."\tRp ".number_format($harga_jual, 0, ',', '.')."\tRp ".number_format($total_bayar, 0, ',', '.')."\tRp ".number_format($keuntungan, 0, ',', '.')."\n";
            $no++;
            $total_penjualan += $harga_jual;
            $total_keuntungan += $keuntungan;
            $jumlah_transaksi++;
        }
        echo "\n\t\t\t\t\t\t\t\t\t\n";
        echo "\t\t\t\t\tJumlah transaksi :\t".$jumlah_transaksi."\n";
        echo "\t\t\t\t\tTotal penjualan :\tRp ".number_format($total_penjualan, 0, ',', '.')."\n";
        echo "\t\t\t\t\tKeuntungan :\tRp ".number_format($total_keuntungan, 0, ',', '.')."\n";
        exit;
    }

    public function export_csv()
    {
        $this->load->model('sale_m');
        $sales = $this->sale_m->get_sale()->result();
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="sale_report.csv"');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['No.', 'Invoice', 'Name Customer', 'Discount', 'Note', 'Date', 'Petugas']);
        $no = 1;
        foreach ($sales as $s) {
            $customer = $s->customer_name != null ? $s->customer_name : "Umum";
            fputcsv($output, [$no++, $s->invoice, $customer, $s->discount, $s->note, indo_date($s->date), $s->user_name]);
        }
        fclose($output);
        exit;
    }

    public function export_pdf()
    {
        $this->load->model('sale_m');
        $sales = $this->sale_m->get_sale()->result();
        $tanggal_hari_ini = date('Y-m-d');
        $jumlah_transaksi = 0;
        $total_penjualan_hari_ini = 0;
        foreach ($sales as $s) {
            if (isset($s->date) && date('Y-m-d', strtotime($s->date)) == $tanggal_hari_ini) {
                $jumlah_transaksi++;
                $total_penjualan_hari_ini += isset($s->final_price) ? $s->final_price : 0;
            }
        }
        $data = [
            'sales' => $sales,
            'jumlah_transaksi' => $jumlah_transaksi,
            'total_penjualan_hari_ini' => $total_penjualan_hari_ini,
            'tanggal_hari_ini' => $tanggal_hari_ini
        ];
        $html = $this->load->view('reports/sale_report_pdf', $data, true);
        $this->fungsi->PdfGenerator($html, 'sale_report', 'A4', 'landscape');
    }
    public function delete_sale($invoice)
    {
        $this->load->model('sale_m');
        $this->sale_m->delete_by_invoice($invoice);
        $this->session->set_flashdata('pesan', 'Data penjualan berhasil dihapus!');
        redirect('reports/sale_report');
    }
    public function delete_all_sales()
    {
        $this->load->model('sale_m');
        $this->sale_m->delete_all_sales();
        $this->session->set_flashdata('pesan', 'Seluruh data penjualan berhasil dihapus!');
        redirect('reports/sale_report');
    }
}
