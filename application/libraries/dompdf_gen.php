<?php
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Dompdf_gen {
    public $dompdf;
    public function __construct() {
        $this->dompdf = new Dompdf();
    }
    public function load_html($html) {
        $this->dompdf->loadHtml($html);
    }
    public function set_paper($paper, $orientation) {
        $this->dompdf->setPaper($paper, $orientation);
    }
    public function render() {
        $this->dompdf->render();
    }
    public function stream($filename, $options) {
        $this->dompdf->stream($filename, $options);
    }
}
