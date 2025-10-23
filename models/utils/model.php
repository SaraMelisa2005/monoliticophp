<?php
namespace App\Models\Utils;

abstract class Model
{
    abstract public function all();
    abstract public function save();
    abstract public function update();
    abstract public function delete();
}