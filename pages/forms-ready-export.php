<?php
class CSVExport
{
    /**
    * Constructor
    */
    public function __construct()
    {
        if(isset($_GET['export']))
        {
        $csv = $this->generate_csv();
        $generatedDate = date('d-m-Y His'); 
        ob_clean();
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"ready-forms-{$generatedDate}.csv\";" );
        header("Content-Transfer-Encoding: binary");
        echo $csv;        
        exit;
        }
    }

    /**
    * Converting data to CSV
    */
    public function generate_csv()
    {
        global $wpdb;
        $csv_output = '';
        $postId = $_GET['export'];
        $multiple = (isset($_GET['multiple']) ? $_GET['multiple'] : '');
        if(!empty($multiple)){
            $get_post_data = $wpdb->get_results("SELECT pm.meta_key as title , pm.meta_value as value FROM gpm_postmeta as pm WHERE  pm.post_id IN ($postId) AND pm.meta_key LIKE '_comp_%'");
        } else {
            $get_post_data = $wpdb->get_results("SELECT pm.meta_key as title , pm.meta_value as value FROM gpm_postmeta as pm WHERE pm.post_id=$postId AND pm.meta_key LIKE '_comp_%'");
        }
        
        $csv_output .= "Title,Values,";
        $csv_output .= "\n";

        foreach ($get_post_data as $key => $value) {
            $export_title = explode("_", $value->title);
            $csv_output .= ucfirst($export_title[2])." ".ucfirst($export_title[3]).",";
            $csv_output .= $value->value.",";
            $csv_output .= "\n";
        }

        return $csv_output;
    }
}

// Instantiate a singleton of this plugin
$csvExport = new CSVExport();

?>