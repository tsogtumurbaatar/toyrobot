<?php

namespace App;

class ToyRobot
{

    protected $x;
    protected $y;
    protected $face;  /*  0 - North
                          1 - South
                          2 - East
                          3 - West   */ 

    public function __construct()
    {
        $this->x = 0;
        $this->y = 0;
        $this->face = 0;

    }

    public function place($x,$y,$face)
    {

       
        if(!ctype_digit(strval($x)))
            return "Value of X not integer, example: place 2,3,west";
         
        if(!ctype_digit(strval($y)))
            return "Value of Y not integer, example: place 2,3,west";
    
        if($x>6)
        return "Value of X must be less than 6, example: place 2,3,west";

        if($y>6)
        return "Value of Y must be less than 6, example: place 2,3,west";
        
        if(strcmp($face,'west')&&strcmp($face,'east')&&strcmp($face,'north')&&strcmp($face,'south'))
        return "Value of facing not clear, example: place 2,3,west";
        else
        {
            $this->x = $x;
            $this->y = $y;
            if(!strcmp($face,'north')) $this->face = 0;
            if(!strcmp($face,'south')) $this->face = 1;
            if(!strcmp($face,'east')) $this->face = 2;
            if(!strcmp($face,'west')) $this->face = 3;
            return "1";
         }

    }

    public function move()
    {

        if($this->face == 0)
            if($this->y +1 > 5) 
                return "Command not performed, the Robot will fall";
            else
                $this->y = $this->y +1;

        if($this->face == 1)
            if($this->y  == 0) 
                return "Command not performed, the Robot will fall";
            else
                $this->y = $this->y -1;


        if($this->face == 2)
            if($this->x +1 > 5) 
                return "Command not performed, the Robot will fall";
            else
                $this->x = $this->x +1;


        if($this->face == 3)
            if($this->x  == 0) 
                return "Command not performed, the Robot will fall";
            else
                $this->x = $this->x -1;

        return "";    
    }

    public function left()
    {
 
        if($this->face == 0)
            $this->face = 3;
        elseif($this->face == 1)
            $this->face = 2;
        elseif($this->face == 2)
            $this->face = 0;
        elseif($this->face == 3)
            $this->face = 1;

    }

    public function right()
    {
    
        if($this->face == 0)
            $this->face = 2;
        elseif($this->face == 1)
            $this->face = 3;
        elseif($this->face == 2)
            $this->face = 1;
        elseif($this->face == 3)
            $this->face = 0;
    }

      public function report()
    {
    
       if($this->face == 0)
       $face_string = "NORTH";
       
       if($this->face == 1)
       $face_string = "SOUTH";
       
       if($this->face == 2)
       $face_string = "EAST";
       
       if($this->face == 3)
       $face_string = "WEST";

       return "Output : ".$this->x.",".$this->y.",".$face_string;
    }

}
