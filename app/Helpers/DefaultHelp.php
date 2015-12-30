<?php

class DefaultHelp {

    public static function defaultArea($id = "") {
        $data = \App\Models\Areas::all();

        $selecttop = '<select name="area_id" id="area_id"  class="form-control select2">';
        $option = '<option value="">- Pilih Area -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->name_area'>$value->id - $value->name_area</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function defaultBanks($param = "") {
        $data = \App\Models\Banks::all();

        $selecttop = '<select name="bank_id" id="bank_id"  class="form-control select2">';
        $option = '<option value="">- Pilih Bank -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->name'>$value->id - $value->name</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function defaultLocation($param = "") {
        $data = \App\Models\Locations::all();

        $selecttop = '<select name="location_id" id="location_id"  class="form-control ">';
        $option = '<option value="">- Select Location -</option>';
        foreach ($data as $key => $value) {
            if ($param != "") {
                $option = $option . "<option value='$value->name'>$value->name</option>";
            } else {
                $option = $option . "<option value='$value->name'>$value->name</option>";
            }
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function locationCode() {
        $data = \App\Models\Locations::orderBy('id','asc')->get();

        $selecttop = '<select name="code" id="code"  class="form-control ">';
        $option = '<option value="">- Pilih Lokasi -</option>';
        foreach ($data as $key => $value) {
                $nameArea = self::areaName($value->area_id);
                $option = $option . "<option value='$value->area_id|$value->id'>$value->area_id - $nameArea</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function machineCode($area_id = "") {
        $data = \App\Models\Machines::all();
        if($area_id != "") $data = \App\Models\Machines::where('area_id', $area_id)->get();

        $selecttop = '<select name="code" id="code"  class="form-control ">';
        $option = '<option value="">- Pilih Lokasi -</option>';
        foreach ($data as $key => $value) {
                $nameArea = self::areaName($value->area_id);
                $nameLocation = self::locationName($value->location_id);
                $option = $option . "<option value='$value->area_id|$value->location_id|$value->id'>$value->location_id - $nameLocation</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function defaultTypeReport() {
        $data = \App\Models\ListReports::select(\DB::raw('sum(id)'),'type')->groupBy('type')->get();

        $selecttop = '<select name="type" id="type"  class="form-control ">';
        $option = '<option value="">- Pilih Tipe -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->type'>$value->type</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    /*
    * Names
    */

    public static function takeName($id, $model, $name){
        $model = '\\App\\Models\\' . $model;
        $data = $model::find($id);
        return (count($data) > 0 ? $data->$name : $id);
    }

    public static function shiftName($id){
        return \App\Models\Shift::where('code', $id)->first()->name;
    }

    public static function bankName($id){
        return \App\Models\Banks::where('id', $id)->first()->name;
    }

    public static function areaName($id){
        return \App\Models\Areas::where('id', $id)->first()->name_area;
    }

    public static function locationName($id){
        return \App\Models\Locations::where('id', $id)->first()->name;
    }

    public static function machineName($id){
        return \App\Models\Machines::where('id', $id)->first()->name_machine;
    }

    //  Income Filter

    public static function shiftFilter() {
        $data = \App\Models\Shift::all();

        $selecttop = '<select name="shift_id" id="shift_id"  class="form-control select2">';
        $option = '<option value="">- Pilih Shift -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->code'>$value->code - $value->shift_name</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function banksFilter($param = "") {
        $data = \App\Models\Banks::all();

        $selecttop = '<select name="bank_id" id="bank_id"  class="form-control select2">';
        $option = '<option value="">- Pilih Bank -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->id'>$value->id - $value->name</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function areasFilter($id = "") {
        $data = \App\Models\Areas::all();

        $selecttop = '<select name="area_id" id="area_id"  class="form-control select2">';
        $option = '<option value="">- Pilih Area -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->id'>$value->id - $value->name_area</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function locationFilter($id = "") {
        $data = \App\Models\Locations::all();
        if($id != "") $data = \App\Models\Locations::where('area_id',$id)->get();

        $selecttop = '<select name="location_id" id="location_id"  class="form-control select2">';
        $option = '<option value="">- Select Location -</option>';
        foreach ($data as $key => $value) {
            $option = $option . "<option value='$value->id'>$value->name</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

    public static function machinesFilter($area_id,$location_id = "") {
        $data = \App\Models\Machines::all();
        if($location_id != "" && $area_id != "")
            $data = \App\Models\Machines::where('area_id', $area_id)->where('location_id', $location_id)->get();

        $selecttop = '<select name="filter_machine" id="filter_machine"  class="form-control select2">';
        $option = '<option value="">- Pilih Mesin -</option>';
        foreach ($data as $key => $value) {
                $option = $option . "<option value='$value->id'>$value->name_machine</option>";
        }
        $selectbottom = '</select>';

        $list = $selecttop . $option . $selectbottom;

        return $list;
    }

}
