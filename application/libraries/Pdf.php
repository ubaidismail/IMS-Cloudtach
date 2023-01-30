<?php defined('BASEPATH') or exit('No direct script access allowed');

// reference the Dompdf namespace
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
 public function __construct()
 {
   parent::__construct();
 } 
}