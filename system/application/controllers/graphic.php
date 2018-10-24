<?php 
  class graphic extends Controller { 
    // Constructor 
    function graphic() 
    { 
      parent:: Controller(); 
      // Url helper 
      $this->load->helper('url'); 
      // Form helper 
      $this->load->helper('form'); 
      // String helper 
      $this->load->helper('string'); 
    }
    // Phplot test, 
    // Todo: phplot own parameters too shrewd not to understand 
	function graph($title,$data)
	{
		require_once 'lib/graph/phplot.php';
		# Define the data array: Label, the 3 data sets.
		# Year,  Features, Bugs, Happy Users:
		

		# Create a PHPlot object which will make a 600x400 pixel image:
		$p = new PHPlot(600, 400);

		# Use TrueType fonts:
		$p->SetDefaultTTFont('font/arial.ttf');
		$p->SetFontTTF('x_title','font/arial.ttf',10);
		$p->SetFontTTF('y_title','font/arial.ttf',10);
		$p->SetFontTTF('y_label','font/arial.ttf',10);
		$p->SetFontTTF('x_label','font/arial.ttf',10);

		# Set the main plot title:
		$p->SetTitle($title);

		# Select the data array representation and store the data:
		$p->SetDataType('text-data');
		$p->SetDataValues($data);

		# Select the plot type - bar chart:
		$p->SetPlotType('bars');

		# Define the data range. PHPlot can do this automatically, but not as well.
		//$p->SetPlotAreaWorld(0, 0, 11, 100);

		# Select an overall image background color and another color under the plot:
		$p->SetBackgroundColor('#aabbcc');
		$p->SetDrawPlotAreaBackground(True);
		$p->SetPlotBgColor('#aabbcc');

		# Draw lines on all 4 sides of the plot:
		$p->SetPlotBorderType('full');

		# Set a 3 line legend, and position it in the upper left corner:
		$p->SetLegend(array( 'Начислено', 'Оплачено'));
		//$p->SetLegendWorld(0.1, 95);

		# Turn data labels on, and all ticks and tick labels off:
		$p->SetXTitle('период');
		
		$p->SetXDataLabelPos('plotdown');
		$p->SetXTickPos('none');
		$p->SetXTickLabelPos('none');
		$p->SetYTickPos('plotleft');
		$p->SetYTickLabelPos('yaxis');

		# Generate and output the graph now:
		$p->DrawGraph();
	}
    function index() 
    {
		$data = array();
		$this->db->where('firm_id',$this->uri->segment(3));
		$arr=$this->db->get("industry.graph_oplata_nachislenie");
		foreach ($arr->result() as $a)
		{
			$data[]=array($a->begin_date,$a->oplata_value,$a->nachisleno);
		}
		$title='Начисление и оплата Дог.3 ЧЛ Джаниева Э.М., кафе "Ковбой"';
		$this->graph($title,$data);
	}
 }
?>