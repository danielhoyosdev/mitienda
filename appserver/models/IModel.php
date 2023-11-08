<?php
interface IModel{
    public function insert($obj);

    public function get();

    public function update($obj);

    public function delete();
}