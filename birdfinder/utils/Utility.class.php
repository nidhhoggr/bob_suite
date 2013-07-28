<?php
class Utility
{
    public function dehumanizeString($str)
    {
        $delimiter = "-";

        $clean = trim($str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
    }

    public function humanizeString($name) {

        $words = explode('-',$name);

        foreach($words as $k=>$v) {
        
            if($v!="and")
                $words[$k] = ucfirst($v);
        }   

        $words = implode(' ',$words);
 
        return $words;
    }

    function getGoogleImg($k) {
        $link = "http://images.google.com/images?q=$k&tbm=isch";
        $code = file_get_contents($link,'r');

        ereg ("imgurl=http://www.[A-Za-z0-9-]*.[A-Za-z]*[^.]*.[A-Za-z]*", $code, $img);
        ereg ("http://(.*)", $img[0], $img_pic);

        $firstImage = $img_pic[0];
        $firstImage = trim("$firstImage");

        // Display image
        return $firstImage;
    }

    function findSimilarFromSortedResult($result, $exceptions = array() , $trimmables = array(), $verbose = false)
    {
        $matching_rows = array();

        foreach ($result as $k => $v) {

            $row1 = $result[$k]['name'];

            $row2 = $result[$k + 1]['name'];

            if (!in_array($row1, $exceptions) && !in_array($row2, $exceptions)) {

                $string1 = $this->getTrimmable($row1, $trimmables);

                $string2 = $this->getTrimmable($row2, $trimmables);

                //first find the substring offset by the stringlesngths
                $to_consider = min(array(
                    strlen($string1) ,
                    strlen($string2)
                ));

                $offset_size = ($to_consider >= 10) ? 10 : $to_consider;

                $percentage = (int)round($offset_size * .4);

                $value1 = substr($string1, 0, $offset_size);

                $value2 = substr($string2, 0, $offset_size);

                if (levenshtein($value1, $value2) < $percentage) {

                    if($verbose) echo $row1 . ' | ' . $row2 . "<br />";

                    $represent = (strlen($row1) > strlen($row2)) ? $row1 : $row2;

                    $matching_rows[$represent] = array(
                        $result[$k]['id'],
                        $result[$k + 1]['id']
                    );
                }
            }
        }

        return $matching_rows;
    }

    function findNEquivelantFromSortedResult($n,$result, $exceptions = array(), $verbose = false)
    {
        $matching_rows = array();

        foreach ($result as $k => $v) {

            $exceptionFound = false;

            $istShisen = false;

            for($i=0;$i<=$n-1;$i++) {
                $row[$i] = $result[$k + $i]['name'];
            }

            for($i=0;$i<=$n-1;$i++) {
                if(in_array($row[$i],$exceptions)) $exceptionFound = true;
            }

            if (!$exceptionFound) {

                //first find the substring offset by the stringlesngths

                for($i=0;$i<=$n-1;$i++) {
                    if($row[$i]!=$row[$i+1] && !empty($row[$i+1])) { $istShisen = true; break; }
                }

                if (!$istShisen) {

                    if($verbose) {

                        for($i=0;$i<=$n-1;$i++) {
                            echo $row[$i]  . ' | ';
                        }
                     
                        echo "<br />";
                    }

                    $represent = max($row);

                    for($i=0;$i<=$n-1;$i++) {
                        $matching_rows[$represent][] = $result[$k + $i]['id'];
                    }
                }
            }
        }

        return $matching_rows;
    }

    function getTrimmable($string, $trimmables = array())
    {

        foreach ($trimmables as $trimmable) {

            if (strstr($string, $trimmable)) {
                $string = str_replace($trimmable, '', $string);
            }
        }

        return $string;
    }

    function dbPutArray($array) {
          return implode(',',$array);
//        return base64_encode(serialize($array));
    }

    function dbGetArray($array) {

          $arr = explode(',',$array);

          $newarr['nid'] = $arr[0];
          $newarr['tid'] = $arr[1];

          return $newarr;
//        return unserialize(base64_decode($array));
    }
}

