<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helpers
 *
 * @author br03206
 */


class Helpers extends Model {
    
    public function dataTable($query){        
        $data = [];
        $data = $query -> fetchAll(\PDO::FETCH_ASSOC);               
        
        $response = ['data' => $data];

        return $response;
    }
    
}
