<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CSVReader Class
 * 
 * $Id: csvreader.php 54 2009-10-21 21:01:52Z Pierre-Jean $
 * 
 * Allows to retrieve a CSV file content as a two dimensional array.
 * Optionally, the first text line may contains the column names to
 * be used to retrieve fields values (default).
 * 
 * Let's consider the following CSV formatted data:
 * 
 *        "col1";"col2";"col3"
 *         "11";"12";"13"
 *         "21;"22;"2;3"
 * 
 * It's returned as follow by the parsing operation with first line
 * used to name fields:
 * 
 *         Array(
 *             [0] => Array(
 *                     [col1] => 11,
 *                     [col2] => 12,
 *                     [col3] => 13
 *             )
 *             [1] => Array(
 *                     [col1] => 21,
 *                     [col2] => 22,
 *                     [col3] => 2;3
 *             )
 *        )
 * 
 * @author        Pierre-Jean Turpeau
 * @link        http://www.codeigniter.com/wiki/CSVReader
 */
class CSVReader {

    var $fields;            /** columns names retrieved after parsing */ 
    var $separator = ';';    /** separator used to explode each line */
    var $enclosure = '"';    /** enclosure used to decorate each field */

    var $max_row_size = 4096;    /** maximum row size to be used for decoding */

    /**
     * Parse a file containing CSV formatted data.
     *
     * @access    public
     * @param    string
     * @param    boolean
     * @return    array
     */
	 
	 function fgetcsv2($f_handle, $length, $delimiter=';', $enclosure='"') 
	 {

		//если указатель на файл не задан, то возвращаем false
		if (!$f_handle || feof($f_handle))
		return false;

		//если разделитель не задан, то возвращаем false
		if (strlen($delimiter) > 1)
		$delimiter = substr($delimiter, 0, 1);
		elseif (!strlen($delimiter))
		return false;

		if (strlen($enclosure) > 1) // There _MAY_ be an enclosure
		$enclosure = substr($enclosure, 0, 1);

		$line = fgets($f_handle, $length);
		if (!$line)
		return false;
		$result = array();
		$csv_fields = explode($delimiter, trim($line));
		$csv_field_count = count($csv_fields);
		$encl_len = strlen($enclosure);
		for ($i = 0; $i < $csv_field_count; $i++) {
			if ($encl_len && $csv_fields[$i]{0} == $enclosure)
				$csv_fields[$i] = substr($csv_fields[$i], 1);
			if ($encl_len && $csv_fields[$i]{strlen($csv_fields[$i]) - 1} == $enclosure)
				$csv_fields[$i] = substr($csv_fields[$i], 0, strlen($csv_fields[$i]) - 1);
			$csv_fields[$i] = str_replace($enclosure . $enclosure, $enclosure, $csv_fields[$i]);
			$result[] = $csv_fields[$i];
		}
		return $result;
	}
	 
    function parse_file($p_Filepath, $p_NamedFields = true) {
        $content = false;  

		header('Content-type: text/html; charset=utf-8');
		//if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');
        $file = fopen($p_Filepath, 'r');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
        if($p_NamedFields) {
            $this->fields = $this->fgetcsv2($file, $this->max_row_size, $this->separator, $this->enclosure);
        }
        while( ($row = $this->fgetcsv2($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ) {            
            if( $row[0] != null ) { // skip empty lines
                if( !$content ) {
                    $content = array();
                }
                if( $p_NamedFields ) {
                    $items = array();

                    // I prefer to fill the array with values of defined fields
                    foreach( $this->fields as $id => $field ) {
                        if( isset($row[$id]) ) {
                            $items[$field] = $row[$id];    
                        }
                    }
                    $content[] = $items;
                } else {
                    $content[] = $row;
                }
            }
        }
        fclose($file);
        return $content;
    }
}
?>