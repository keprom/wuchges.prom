<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 
  // Phplot 
  // Purpose, phplot Invokation complicated because of the wrapper to simplify bitten
  // @ Version 0.01-alpha
  // @ Link http://d.hatena.ne.jp/dix3/20081125/1227568495
  // TODO: adjust the default parameters
  // TODO: remove unnecessary files around to a more refined
  // TODO: measures to deny direct links
  // TODO: Construction of comments
  
  class Graph {
    var $CI;
    var $obj;

    var $base_path = 'public/images/';
    var $random_file_prefix = 'plot'; // generate a random file of the file name prefix
    var $random_file_name_length = 12; // When a random file name prefix, suffix, excluding the length of
    var $old_file_del_flg = true; // generate the underlying base_path to delete old files?
    var $old_file_del_span = 10; // save old files in seconds
    var $font_path; // font for the chart Pass

    var $width; // Width
    var $height; // Height
    var $file_path; // generate the full path of files
    var $url; // generate the URL of the file
    var $input_file_path; //

    var $data;
    var $status;

    function Graph($params = array())
    {
      $this->CI=get_instance();
      $this->CI->load->helper('string');
      $this->CI->load->helper('url');
      $this->CI->load->helper('file');
      $this->CI->load->helper('html');
      // Initialization
      $this->init($params);
    }
    // Initialization
    function init($params=array())
    {
      require_once('graph/phplot.php');
      // Fonts
      $default_font_path = BASEPATH. 'fonts/sazanami-gothic.ttf';
      if(isset($params['font_path']) && realpath($params['font_path']) && is_file(realpath($params['font_path']))) {
        $this->font_path = $params['font_path'];
      }else {
        if(isset($default_font_path) && realpath($default_font_path) && is_file(realpath($default_font_path))) {
          $this->font_path = $default_font_path;
        }
      }
      // Generate a directory to save the file
      $this->base_path = isset($params['base_path']) ? $params['base_path']: $this->base_path;
      // Generate a random file of the file name prefix
      $this->random_file_prefix = isset($params['random_file_prefix']) ? $params['random_file_prefix']: $this->random_file_prefix;
      // When a random file name prefix, suffix, excluding the length of
      $this->random_file_name_length = isset($params['random_file_name_length']) ? (int) $params['random_file_name_length']: $this->random_file_name_length;
      // Delete old files after generation?
      $this->old_file_del_flg = isset($params['old_file_del_flg']) ? $params['old_file_del_flg']: $this->old_file_del_flg;
      // Width
      $this->width = isset($params['width']) ? (int) $params['width']: 450;
      // Height
      $this->height = isset($params['height']) ? (int) $params['height']: 350;
      // Chart the path to save the file
      $fpath = isset($params['path']) ? $params['path']:'';
      // Graph file name, without specifying the file name at random. Png to
      $fname = isset($params['name']) ? $params['name']: $this->random_file_prefix. '_'. random_string('alnum', $this->random_file_name_length).'_'.time().'.png';
      // Base path
      if($fpath && realpath($fpath)) {
        $this->file_path = rtrim(realpath($fpath),'/').'/'.$fname;
      }else {
        // Base path is not specified when the document root / img / plot / created the following
        if(! realpath($this->base_path) ||! is_dir(realpath($this->base_path))) {
          mkdir($this->base_path,0755);
        }
        $this->file_path = realpath($this->base_path).'/'.$fname;
      }
      // Generate the URL of the file
      $this->url = rtrim(base_url(), '/'). '/'. rtrim($this->base_path, '/'). '/'. $fname;
      //
      if(isset($params['input']) && realpath($params['input']) && is_file (realpath($params['input']))) {
        $this->input_file_path = $params['input'];
      }else {
        $this->input_file_path = NULL;
      }
      $this->obj = new PHPlot($this->width, $this->height, $this->file_path, $this->input_file_path);
    }
    // Data and a set of parameters
    function setdata($data = array(), $params = array())
    {
      if(! $data ||! is_array($data)) {
        return false;
      }else {
        $this->data = $data;
      }
      // Default set of parameters
      $this->_setdefaultparams();

      // Add a set of parameters
      if($params){
        $this->_setparams($params);
      }
      $this->obj->SetDataValues($this->data);

      return true;
    }
    // Default set of parameters, todo: a good feeling to be adjusted.
    //(Add as much as possible parameters to be adjusted to a good Does Not Pass)
    function _setdefaultparams()
    {
      // Specify the font
      if($this->font_path) {
        $this->obj->SetDefaultTTFont($this->font_path);
      }
      // Generated as a file
      $this->obj->SetIsInline(true);
      // Select the data array representation and store the data:
      $this->obj->SetDataType('text-data');
      // Background color
      $this->obj->SetBackgroundColor('#dddddd');
      $this->obj->SetPlotBgColor('#f9f9f9');
      $this->obj->SetDrawPlotAreaBackground(true);
      // Font size
      if($this->font_path) {
        $this->obj->SetFont('generic', $this->font_path, 9);
        $this->obj->SetFont('title', $this->font_path, 11);
        $this->obj->SetFont('x_label', $this->font_path, 9);
        $this->obj->SetFont('y_label', $this->font_path, 9);
      }
      // Inner border
      $this->obj->SetPlotBorderType('full');
      // Legend of the position
      // $this->obj->SetLegendWorld(0.1, 30);
      // Define the data range. PHPlot can do this automatically, but not as well.
      // $this->obj->SetPlotAreaWorld(0, 0, 7, 100);
      // Label or the presence or absence of increments and position
      $this->obj->SetXTickPos('none');
      $this->obj->SetXTickLabelPos('none');
      // $this->obj->SetXDataLabelPos('plotdown');
      // $this->obj->SetYTickPos('plotright');
      // $this->obj->SetYTickLabelPos('plotright');
      return true;
    }
    // Add a set of parameters
    function _setparams($params = array())
    {
      $class_methods = get_class_methods(get_class($this->obj));
      // Call various methods to set the parameters Dashi
      foreach($params as $k => $v) {
        if(in_array($k, $class_methods)) {
          if(is_array($v)) {
            $this->obj->$k($v);
          }elseif(is_string($v)) {
            // TODO: Later, I could write a more beautiful?
            $p = explode(',', $v);
            $cnt = count($p);
            switch($cnt) {
              case 1:
                $this->obj->$k($p[0]);
                break;
              case 2:
                $this->obj->$k($p[0], $p[1]);
                break;
              case 3:
                $this->obj->$k($p[0], $p[1], $p[2]);
                break;
              case 4:
                $this->obj->$k($p[0], $p[1], $p[2], $p[3]);
                break;
              case 5:
                $this->obj->$k($p[0], $p[1], $p[2], $p[3], $p[4]);
                break;
              default:
                break;
            }
          }else {
          }
        }
      }
      return true;
    }
    // Generate the graph files
    function draw()
    {
      if($this->data) {
        if($this->old_file_del_flg) {
          $this ->gcfiles();
        }
        $this->status = $this->obj->DrawGraph();
        return $this->status;
      }else {
        return false;
      }
    }
    // Generate a graph to obtain the URL of the file
    function geturl()
    {
      return ($this->status) ? $this->url:'';
    }
    // Generate a graph of the image files to obtain tags
    function getimg($index_page = FALSE)
    {
      return ($this->status) ? img($this->url, $index_page):'';
    }
    // Old image file (an image file of random file name) removed
    function gcfiles()
    {
      $file_arr = get_dir_file_info($this->base_path);
      $now = time();
      if(is_array($file_arr)) {
        $regexp = '#^'. $this->random_file_prefix."_.{{$this->random_file_name_length}}_\d+\..+$#u";
        foreach($file_arr as $k => $v) {
          if(preg_match($regexp, basename($v['name']))) {
            // Delete old files
            if(((int) $now -($v['date'] +(int) $this->old_file_del_span))> 0) {
              @unlink ($v['server_path']);
            }
          }
        }
      }
    }
  } 
?>