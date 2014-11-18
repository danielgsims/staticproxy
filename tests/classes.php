<?php

class StaticGuy
{
   static public function normal($a, $b, $c)
   {
        return [$a, $b, $c];
   }

   static public function defaultArgs($a = 1, $b = 2, $c = 3)
   {
        return [$a, $b, $c];
   }

   public function notStatic()
   {
        return "not static";
   }
}
