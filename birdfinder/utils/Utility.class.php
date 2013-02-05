<?php
class Utility
{
    public function dehumanizeString($name)
    {
        //remove commas
        $name = str_replace(',', '', $name);
        //remove spaces with dashes
        $name = str_replace(' ', '-', $name);
        //repace open paren with dash
        $name = str_replace('(', '-', $name);
        //remove close paren
        $name = str_replace(')', '', $name);
        //remove double dashes
        $name = str_replace('--', '-', $name);
        //convert to lowercase
        $name = strtolower($name);
        return $name;
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
}

