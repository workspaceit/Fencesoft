<?php
/*
 * Print to pdf using dompdf HTML to PDF converter
 *
 * For example, to create pdf put this action into controller:
 * <pre>
 * public function actionPrintToPdf()
 * {
 *     Yii::import('ext.vendors.pdf.Pdf',true);
 *     $model = $this->loadModel();
 *     $html = $this->renderPartial('_print', array('model'=>$model), true, true);
 *     $pdf = new Pdf();
 *     $pdf->render($html, '{name of pdf file}');
 * }
 * </pre>
 *
 * @link http://code.google.com/p/dompdf/
 */
class Pdf
{
	public function render($html,$filename,$attachment=1,$paper='a4',$orientation='portrait',$download=false)
	{		
		Yii::import('ext.pdf.dompdf.*');
		require_once ('dompdf_config.inc.php');
		Yii::registerAutoloader('DOMPDF_autoload');
		
		$dompdf=new DOMPDF();
		$dompdf->set_paper($paper,$orientation);
		$dompdf->load_html($html);
		
		$dompdf->render();
		//$dompdf->base_path = Yii::app()->request->baseUrl;
		if($download==true){
			$dompdf->stream($filename.".pdf", array("Attachment"=>$attachment));
		}else {
			return $dompdf->output();
		}
	}
}