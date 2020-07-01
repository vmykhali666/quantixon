<?php


namespace DAO;



use Core\Database;

class MessageDAO
{
    function insertIntoDB(array $data, Database $database) {

        $part1 = " ";
        $part2 = " ";

        foreach ($data as $key => $value) {
            $part1 .= $key . ", ";
            $part2 .= ":" . $key . ", ";
        }

        $part1 = substr($part1, 0 , strlen($part1) - 2);
        $part2 = substr($part2, 0 , strlen($part2) - 2);

        $query = "INSERT INTO messages ( " . $part1 . " ) VALUES ( " . $part2 . " )";
        $database->query($query, $data);
    }

    function insertIntoFile(array $data) {
        $file = date("Y-m-d-H-i-s") . '.txt';
        $current = '';
        foreach ($data as $key => $value) {
            $current .= "$value\t";
        }
        $current .= "\n";

        file_put_contents($file, $current, FILE_APPEND);
    }
}
