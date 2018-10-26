<?php

class Billing extends Controller
{
    function datetostring($date)
    {
        $d = explode("-", $date);
        return $d['2'] . '.' . $d['1'] . '.' . $d['0'];
    }

    function execute($function)
    {
        if (($this->session->userdata('billing/' . $function) == 't') or
            ($this->session->userdata('login') == 'programmist') or
            ($this->session->userdata('login') == 'admin'))
            eval('$this->' . $function . '();');
    }

    function Billing()
    {
        set_time_limit(0);
        parent::Controller();
        $class_method = $this->uri->segment(1) . '/' . $this->uri->segment(2);
        if ($class_method == '/') redirect("billing");
        $is_login = $this->session->userdata('is_login');

        if ($is_login != TRUE) {
            redirect("login/billing");
            die();
        }
        if (($this->session->userdata('login') == 'programmist') or (($this->session->userdata('login') == 'admin') and ($class_method != 'billing/oplata') and ($class_method != 'billing/akt_sverki'))) {
            if (($class_method != 'billing/jpeg') and ($this->session->userdata('admin') == 'programmist'))
                $this->output->enable_profiler(TRUE);
        } else {
            $class_method = $this->uri->segment(1) . '/' . $this->uri->segment(2);
            if ($this->session->userdata($class_method) != 't') {
                if (($class_method == 'billing/') or ($class_method == 'billing/index')) {
                    redirect("login");
                    die('<h1>Доступ запрещен</h1>');
                }
                redirect("billing");
                die('<h1>Доступ запрещен</h1>');
            }
        }
    }

    function left()
    {
        $data['poisk'] = $this->session->userdata('poisk');
        if ($this->session->userdata('poisk') == NULL) $data['poisk'] = '1';
        $this->load->view("left", $data);
    }

    function phpinfo()
    {
        echo phpinfo();
    }

    function index()
    {
        $this->left();
        $this->db->order_by('dogovor');
        $data['query'] = $this->db->get("industry.firm_overview");
        $this->load->view("billing_view", $data);
        $this->load->view("right");
    }

    function my_firm()
    {
        $this->left();
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('dogovor');
        $data['query'] = $this->db->get("industry.firm_overview");
        $this->load->view("billing_view", $data);
        $this->load->view("right");
    }

    function my_firm_not_closed()
    {
        $this->left();
        $this->db->where('is_closed is null', null, FALSE);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('dogovor');
        $data['query'] = $this->db->get("industry.firm_overview");
        $this->load->view("billing_view", $data);
        $this->load->view("right");
    }

    function firm_not_closed()
    {
        $this->left();
        $this->db->where('is_closed is null', null, FALSE);
        $this->db->order_by('dogovor');
        $data['query'] = $this->db->get("industry.firm_overview");
        $this->load->view("billing_view", $data);
        $this->load->view("right");
    }


    function firm()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['r'] = $this->db->get('industry.firm_view')->row();

        $sql = "SELECT period.*,case when sprav.value is not null then 'selected' else '' end  as checked FROM industry.period left join industry.sprav on period.id=sprav.value::integer and sprav.name='current_period' order by id";
        $data['period'] = $this->db->query($sql);
        $sql = "Select industry.is_closed(" . $this->uri->segment(3) . ") as closed";
        $data['is_closed'] = $this->db->query($sql)->row();
        $this->left();
        $this->load->view("firm_view", $data);
        $this->execute("points");
        $this->load->view("right");
    }

    function firm_edit()
    {
        $sql = "SELECT firm.id,firm.dogovor,firm.address, firm.name,  firm.telefon, firm.rnn, firm.dogovor_date FROM industry.firm WHERE  firm.id=" . $this->uri->segment(3);
        $this->db->where('id', $this->uri->segment(3));
        $data['r'] = $this->db->get('industry.firm');

        $sql = "SELECT period.*,case when sprav.value is not null then 'selected' else '' end  as checked FROM industry.period left join industry.sprav on period.id=sprav.value::integer and sprav.name='current_period' order by id";
        $data['period'] = $this->db->query($sql);
        $this->db->order_by('name');
        $data['firm_subgroup'] = $this->db->get('industry.firm_subgroup');
        $this->db->order_by('name');
        $data['user'] = $this->db->get('industry.user');
        $this->db->order_by('name');
        $data['bank'] = $this->db->get('industry.bank');
        $this->db->order_by('name');
        $data['firm_otrasl'] = $this->db->get('industry.firm_otrasl');
        $this->db->order_by('name');
        $data['firm_power_group'] = $this->db->get('industry.firm_power_group');
        $this->db->order_by('name');
        $data['ture'] = $this->db->get('industry.ture');
        $this->left();
        $this->load->view("firm_edit", $data);
        $this->load->view("right");
    }

    function firm_edition()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->update('industry.firm', $_POST);
        redirect("billing/firm/" . $this->uri->segment(3));
    }

    function close_firm()
    {
        $sql = "SELECT industry.close_firm(" . $this->uri->segment(3) . ")";
        $this->db->query($sql);
        redirect("billing");
    }

    function open_firm()
    {
        $sql = "SELECT industry.open_firm(" . $this->uri->segment(3) . ")";
        $this->db->query($sql);
        redirect("billing/firm/" . $this->uri->segment(3));
    }

    function add_firm()
    {
        $data['banks'] = $this->db->get('industry.bank');
        $data['subgroups'] = $this->db->get('industry.firm_subgroup');
        $this->left();
        $this->load->view("add_firm_view", $data);
        $this->load->view("right");
    }

    function adding_firm()
    {
        $_POST['dogovor_date'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        unset($_POST['year']);
        unset($_POST['day']);
        unset($_POST['month']);
        $this->db->insert("industry.firm", $_POST);
        $this->index();
    }

    function firm_search_by()
    {
        $sql = "select distinct firm_id from industry.billing_point_ex where ";
        if ($_POST['type'] != '1') $sql = "select  * from industry.firm_overview where firm_id in ( " . $sql;
        $str = $_POST['str'];
        $this->session->set_userdata(array('poisk' => $_POST['type']));
        if ($_POST['type'] == '1') {
            $sql .= " dogovor = " . $str;
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                redirect("billing/firm/" . $query->row()->firm_id);
            } else {
                redirect("billing/");
            }
        } else {
            if ($_POST['type'] < 8 or $_POST['type'] == 10) {
                $arr = explode(" ", $str);
                $first = true;
                if ($_POST['type'] == 2) {
                    $t = "billing_point_address";
                }
                if ($_POST['type'] == 3) {
                    $t = "firm_address";
                }
                if ($_POST['type'] == 4) {
                    $t = "rnn";
                }
                if ($_POST['type'] == 5) {
                    $t = "tp_name";
                }
                if ($_POST['type'] == 6) {
                    $t = "telefon";
                }
                if ($_POST['type'] == 7) {
                    $t = "firm_name";
                }
                if ($_POST['type'] == 10) {
                    $t = "firm_bin";
                }
                foreach ($arr as $a) {
                    trim($a);
                    if ($first == FALSE) {
                        $sql .= " and $t ilike '%$a%' ";
                        $first = FALSE;
                    }
                    if ($first == TRUE) {
                        $sql .= " $t ilike '%$a%' ";
                        $first = FALSE;
                    }
                }
            }
            $sql .= ") order by dogovor";
            $this->left();
            if ($_POST['type'] == 8) {
                $sql = "select distinct firm.name as firm_name,firm.dogovor,'t' as is_closed,firm.id as firm_id  from industry.counter left join industry.billing_point on billing_point.id=counter.point_id left join industry.firm on firm.id=billing_point.firm_id where counter.gos_nomer like '%" . $_POST['str'] . "'";
            }
            if ($_POST['type'] == 9) {
                $sql = "select distinct firm.name as firm_name,firm.dogovor,'t' as is_closed,firm.id as firm_id  from  industry.schetfactura_date left join industry.firm on schetfactura_date.firm_id=firm.id
				where schetfactura_date.id =" . $_POST['str'];
            }
            $data['query'] = $this->db->query($sql);
            $this->load->view("billing_view", $data);
            $this->load->view("right");
        }
    }

    function gd()
    {
        phpinfo();
    }

    //// СПРАВОЧНИКИ
    function streets()
    {
        $this->db->order_by("name");
        $data['query'] = $this->db->get("common_info.street");
        $this->left();
        $this->load->view("sprav/streets_view", $data);
        $this->load->view("right");
    }

    function adding_streets()
    {
        if (trim($_POST['name']) != "")
            $this->db->insert('common_info.street', $_POST);
        redirect("billing/streets");
    }

    function counter_types()
    {
        $this->db->order_by("name");
        $data['query'] = $this->db->get("industry.counter_type");
        $this->left();
        $this->load->view("sprav/counter_types_view", $data);
        $this->load->view("right");
    }

    function adding_counter_types()
    {
        if (trim($_POST['name']) != "")
            $this->db->insert('industry.counter_type', $_POST);
        redirect("billing/counter_types");
    }

    function tp()
    {
        $this->db->order_by("name");
        $data['query'] = $this->db->get("industry.tp");
        $this->db->order_by("name");
        $data['ture'] = $this->db->get("industry.ture");
        $this->left();
        $this->load->view("sprav/tp_view", $data);
        $this->load->view("right");

    }

    function adding_tp()
    {
        if (trim($_POST['name']) != "")
            $this->db->insert('industry.tp', $_POST);
        redirect("billing/tp");

    }

    function banks()
    {
        $this->db->order_by("name");
        $data['query'] = $this->db->get("industry.bank");
        $this->left();
        $this->load->view("sprav/banks_view", $data);
        $this->load->view("right");

    }

    function bank_edit()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['bank_id'] = $this->uri->segment(3);
        $data['bank'] = $this->db->get('industry.bank')->row();
        $this->left();
        $this->load->view('sprav/bank_edit', $data);
        $this->load->view('right');
    }

    function edition_bank()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->update('industry.bank', $_POST);
        redirect('billing/banks');
    }

    function tariff_list()
    {
        $this->db->order_by("name");
        $data['tariff_list'] = $this->db->get('industry.tariff');
        $this->left();
        $this->load->view('tariff_list', $data);
        $this->load->view('right');
    }

    function adding_tariff()
    {
        $this->db->insert("industry.tariff", $_POST);
        redirect("billing/tariff_list");
    }

    function tariff()
    {
        $this->db->where("id", $this->uri->segment(3));
        $data['tariff'] = $this->db->get('industry.tariff')->row();
        $this->db->where("tariff_id", $this->uri->segment(3));
        $data['tariff_list'] = $this->db->get('industry.tariff_list');
        $this->left();
        $this->load->view('tariff_view', $data);
        $this->load->view('right');
    }

    function adding_tariff_value()
    {
        $sql = "select industry.insert_tariff('{$_POST['date']}',{$_POST['value']},{$this->uri->segment(3)})";
        $this->db->query($sql);
        redirect("billing/tariff/{$this->uri->segment(3)}");
    }

    function adding_banks()
    {
        $this->db->insert('industry.bank', $_POST);
        redirect("billing/banks");
    }

    ///// конец справочники
    function points()
    {
        $sql = "select  *  from industry.billing_point_ex 
				          where billing_point_ex.firm_id=" . $this->uri->segment(3);

        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            $data['result'] = $result;
            $this->load->view("points_view", $data);
        } else {
            echo "Нету точек учета <br><br>";
        }
        $this->execute("add_point");

    }

    function add_point()
    {
        $data['firm_id'] = $this->uri->segment(3);
        $this->db->order_by('name');
        $data['tps'] = $this->db->get('industry.tp');
        $this->load->view("add_billing_point", $data);
    }

    function adding_point()
    {
        $this->db->insert("industry.billing_point", $_POST);
        redirect("billing/firm/" . $_POST['firm_id']);
    }

    function point()
    {
        $sql = "SELECT * FROM industry.billing_point where id=" . $this->uri->segment(3);
        $data['point_data'] = $this->db->query($sql)->row();
        $sql = "SELECT counter.*,counter_type.name as type from industry.counter,industry.counter_type where counter.type_id=counter_type.id and  point_id=" . $this->uri->segment(3);
        $data['query'] = $this->db->query($sql);

        $sql = "select * from industry.counter where data_start is null  and  point_id=" . $this->uri->segment(3);
        $query = $this->db->query($sql);
        $this->left();

        if ($query->num_rows() > 0) $data['snyat'] = 'yes'; else $data['snyat'] = 'false';
        $this->load->view("counters_view", $data);
        if ($data['snyat'] == "false")
            $this->execute("add_counter");
        $this->execute("nadbavka_ot");
        $this->execute("sovm_otn");
        $this->execute("sovm_by_counter");
        $this->load->view("right");
    }

    function break_counter()
    {
        $sql = "select * from industry.counter where data_finish is null and point_id=" . $_POST['point_id'];
        $query = $this->db->query($sql);

        $data_snyatiya = $_POST['day'] . "." . $_POST['month'] . "." . $_POST['year'];
        $sql = "update industry.counter set data_finish='" . $data_snyatiya . "' where id=" . $query->row()->id;
        $this->db->query($sql);
        redirect("billing/point/" . $_POST['point_id']);
    }

    function add_counter()
    {
        $sql = "SELECT * from industry.counter_type order by name";
        $data['types'] = $this->db->query($sql);
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view("add_counter_view", $data);
    }

    function adding_counter()
    {
        $sql = "select * from industry.counter where data_finish is  null and  point_id=" . $_POST['point_id'];
        $query = $this->db->query($sql);
        if ($query->num_rows() != 0) return;
        $_POST['data_start'] = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
        unset($_POST['year']);
        unset($_POST['day']);
        unset($_POST['month']);
        $this->db->insert("industry.counter", $_POST);
        redirect("billing/point/" . $_POST['point_id']);
    }

    function counter()
    {
        $sql = "select values_set.id,tariff.type_name as type from industry.values_set,industry.tariff where tariff.id=values_set.tariff_id and  counter_id=" . $this->uri->segment(3);
        $data['query'] = $this->db->query($sql);
        $data['counter_id'] = $this->uri->segment(3);
        $this->left();
        $this->load->view("counter_view", $data);
        $this->load->view("right");
    }

    function change_counter()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['counter'] = $this->db->get('industry.counter')->row();
        $this->db->order_by('name');
        $data['counter_type'] = $this->db->get('industry.counter_type');
        $this->left();
        $this->load->view("counter_edit", $data);
        $this->load->view("right");
    }

    function changing_counter()
    {
        if ($_POST['data_gos_proverki'] == '') $_POST['data_gos_proverki'] = NULL;
        $this->db->where('id', $this->uri->segment(3));
        $this->db->update('industry.counter', $_POST);
        redirect('billing/counter/' . $this->uri->segment(3));
    }

    function add_sets()
    {
        $sql = "select * from industry.counter where data_finish is null and id=" . $this->uri->segment(3);
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) {
            echo $this->red("billing/counter/" . $this->uri->segment(3));
            return;
        }

        $sql = "select * from industry.tariff";
        $data['tariff'] = $this->db->query($sql);
        $data['counter_id'] = $this->uri->segment(3);
        $this->left();
        $this->load->view("add_sets_view", $data);
        $this->load->view("right");
    }

    function adding_sets()
    {
        $sql = "select * from industry.counter where data_finish is null and id=" . $_POST['counter_id'];
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) return;
        $this->db->insert("industry.values_set", $_POST);
        redirect("billing/counter/" . $_POST['counter_id']);
    }

    function values_sets()
    {
        $this->left();
        $sql = "Select * from industry.counter where id=(select counter_id from industry.values_set where id=" .
            $this->uri->segment(3) . ")";
        $data['counter_data'] = $this->db->query($sql)->row();
        $data['sets_id'] = $this->uri->segment(3);
        $sql = "SELECT tariff_id  from industry.values_set where id=" . $this->uri->segment(3);
        $type_id = $this->db->query($sql)->row()->tariff_id;
        $sql = "SELECT name from industry.tariff where id=" . $type_id;
        $data['sets_type'] = $this->db->query($sql)->row()->name;
        $sql = "SELECT * from industry.counter_value where values_set_id=" . $this->uri->segment(3) . "  order by data";
        $data['query'] = $this->db->query($sql);
        $this->load->view("values_sets_view", $data);
        $this->execute("add_pokazanie");
        $this->execute("nadbavka_ab");
        $this->execute("akt");
        $this->execute("sovm_ab");
        $this->load->view("right");
    }

    function add_pokazanie()
    {
        $sql = "select * from industry.counter where data_finish is null and id=(select counter_id from industry.values_set where id=" . $this->uri->segment(3) . ")";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 0) return;
        $data['set_id'] = $this->uri->segment(3);
        $this->load->view("add_pokazanie_view", $data);
    }

    function adding_pokazanie()
    {
        $this->session->set_userdata(array('day' => $_POST['day'], 'month' => $_POST['month'], 'year' => $_POST['year']));
        $data = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        if (!checkdate($_POST['month'], $_POST['day'], $_POST['year'])) {
            echo $this->red("billing/values_sets/" . $_POST['set_id']);
            return;
        }
        $_POST['data'] = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
        unset($_POST['year']);
        unset($_POST['day']);
        unset($_POST['month']);
        $_POST['uroven'] = 0;
        $this->db->insert("industry.counter_value", $_POST);
        redirect("billing/values_sets/" . $_POST['values_set_id']);
    }

    function delete_pokazanie()
    {
        $query = $this->db->query("select * from industry.counter_value where id=" . $this->uri->segment(3));
        $id = $query->row()->values_set_id;
        $this->db->query("delete from industry.counter_value where id=" . $this->uri->segment(3));
        redirect("billing/values_sets/" . $id);
    }

    function nadbavka_ot()
    {
        $sql = "SELECT * FROM industry.current_ot_nadbavka where billing_point_id=" . $this->uri->segment(3);
        $data['nadbavka'] = $this->db->query($sql);
        $this->load->view('nadbavka_view', $data);
        $this->execute("add_ot_nadbavka");
    }

    function add_ot_nadbavka()
    {
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view('add_nadbavka_view', $data);
    }

    function adding_ot_nadbavka()
    {
        $sql = "SELECT value::integer FROM industry.sprav WHERE name='current_period'";
        $a = $this->db->query($sql)->row()->value;
        $_POST['period_id'] = $a;
        $this->db->insert("industry.nadbavka_otnositelnaya", $_POST);
        redirect("billing/point/" . $_POST['billing_point_id']);
    }

    function nadbavka_ab()
    {
        $sql = "SELECT * FROM industry.current_ab_nadbavka where values_set_id=" . $this->uri->segment(3);
        $data['nadbavka'] = $this->db->query($sql);
        $this->load->view('nadbavka_absolutnaya_view', $data);
        $this->execute("add_ab_nadbavka");
    }

    function add_ab_nadbavka()
    {
        $data['vs_id'] = $this->uri->segment(3);
        $this->load->view('add_nadbavka_absolutnaya_view', $data);
    }

    function adding_ab_nadbavka()
    {
        $_POST['tariff_value'] = 4;
        $_POST['uroven'] = 0;
        $this->db->insert("industry.nadbavka_absolutnaya", $_POST);
        redirect("billing/values_sets/" . $_POST['values_set_id']);
    }

    function sovm_otn()
    {
        $sql = "SELECT * FROM industry.sovm_uchet where child_point_id=" . $this->uri->segment(3);
        $data['query'] = $this->db->query($sql);
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view('sovmestnyy_uchet_view', $data);
        $this->execute("add_sovm_otn");
    }

    function add_sovm_otn()
    {
        $sql = 'select id,dogovor||\'  \'||name as firm_info from industry.firm  order by dogovor';
        $data['firms'] = $this->db->query($sql);
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view('add_sovmestnyy_uchet_view', $data);
    }

    function adding_sovm_otn()
    {
        $this->db->insert("industry.sovmestnyy_uchet", $_POST);
        redirect("billing/point/" . $_POST['child_point_id']);
    }

    function delete_sovm_otn()
    {
        $query = $this->db->query("select * from industry.sovmestnyy_uchet where id=" . $this->uri->segment(3));
        $id = $query->row()->child_point_id;
        $this->db->query("delete from industry.sovmestnyy_uchet where id=" . $this->uri->segment(3));
        redirect("billing/point/" . $id);
    }

    function sovm_ab()
    {
        $sql = "SELECT * FROM industry.sovm_ab where values_set_id=" . $this->uri->segment(3);
        $data['query'] = $this->db->query($sql);
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view('sovmestnyy_absolutnyy_view', $data);
        $this->execute("add_sovm_ab");
    }

    function add_sovm_ab()
    {
        $sql = 'select id,dogovor||\'  \'||name as firm_info from industry.firm order by dogovor';
        $data['firms'] = $this->db->query($sql);
        $data['values_set_id'] = $this->uri->segment(3);
        $this->load->view('add_sovmestnyy_ab_view', $data);
    }

    function adding_sovm_ab()
    {
        $this->db->insert("industry.sovm_absolutnyy", $_POST);
        redirect("billing/values_sets/" . $_POST['values_set_id']);
    }

    function delete_sovm_ab()
    {
        $query = $this->db->query("select * from industry.sovm_absolutnyy where id=" . $this->uri->segment(3));
        $id = $query->row()->values_set_id;
        $this->db->query("delete from industry.sovm_absolutnyy where id=" . $this->uri->segment(3));
        redirect("billing/values_sets/" . $id);
    }

    function sovm_by_counter()
    {
        $sql = "SELECT * FROM industry.sovm_by_counter where billing_point_id=" . $this->uri->segment(3);
        $data['query'] = $this->db->query($sql);
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view('sovm_by_counter_view', $data);
        $this->execute("add_sovm_by_counter");
    }

    function add_sovm_by_counter()
    {
        $sql = 'select id,dogovor||\'  \'||name as firm_info from industry.firm  order by dogovor';
        $data['firms'] = $this->db->query($sql);
        $data['point_id'] = $this->uri->segment(3);
        $this->load->view('add_sovm_by_counter_view', $data);
    }

    function adding_sovm_by_counter()
    {
        $this->db->insert("industry.sovm_by_counter_value", $_POST);
        redirect("billing/point/" . $_POST['billing_point_id']);
    }

    function delete_sovm_by_counter()
    {
        $query = $this->db->query("select * from industry.sovm_by_counter_value where id=" . $this->uri->segment(3));
        $id = $query->row()->billing_point_id;
        $this->db->query("delete from industry.sovm_by_counter_value where id=" . $this->uri->segment(3));
        redirect("billing/point/" . $id);
    }

    function delete_ot_nadbavka()
    {
        $id = $this->db->query("select billing_point_id from industry.nadbavka_otnositelnaya where id=" . $this->uri->segment(3))->row()->billing_point_id;
        $this->db->query("delete from industry.nadbavka_otnositelnaya where id=" . $this->uri->segment(3));
        redirect("billing/point/" . $id);
    }

    function delete_ab_nadbavka()
    {
        $id = $this->db->query("select values_set_id from industry.nadbavka_absolutnaya where id=" . $this->uri->segment(3))->row()->values_set_id;
        $this->db->query("delete from industry.nadbavka_absolutnaya where id=" . $this->uri->segment(3));
        redirect("billing/values_sets/" . $id);
    }

    function vedomost()
    {
        $this->load->library("pdf/pdf");

        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $this->pdf->SetAutoPageBreak(TRUE);
        // set font
        $this->pdf->SetFont('dejavusans', '', 9);

        // add a page
        $this->pdf->AddPage('L');

        $sql = "SELECT * FROM industry.firm WHERE id=" . $_POST['firm_id'];
        $data['firm'] = $this->db->query($sql)->row();
        $sql = "SELECT * FROM industry.vedomost WHERE firm_id=" . $_POST['firm_id'] . " and period_id=" . $_POST['period_id'];
        $data['vedomost'] = $this->db->query($sql);
        $sql = "SELECT * FROM industry.vedomost_itog 		where firm_id=" . $_POST['firm_id'] . " and period_id=" . $_POST['period_id'];
        $data['itogo'] = $this->db->query($sql)->row();
        $sql = "SELECT * FROM industry.firm_oplata_itog 	where firm_id=" . $_POST['firm_id'] . " and period_id=" . $_POST['period_id'];
        if ($this->db->query($sql)->num_rows() > 0) {
            $data['oplata_value'] = $this->db->query($sql)->row()->oplata_value;
        } else
            $data['oplata_value'] = 0;
        $string = $this->load->view("reports/vedomost", $data, TRUE);
        $this->pdf->writeHTML($string);

        //Close and output PDF document
        $this->pdf->Output('example_001.pdf', 'I');

    }

    function pre_akt_sverki()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['r'] = $this->db->get('industry.firm')->row();
        $sql = "SELECT value::integer as current_period FROM industry.sprav WHERE name='current_period'";
        $data['current_period'] = $this->db->query($sql)->row()->current_period;
        $data['period'] = $this->db->get('industry.period');
        $data['firm_id'] = $this->uri->segment(3);
        $this->left();
        $this->load->view("pre_akt_sverki", $data);
        $this->load->view("right");
    }

    function akt_sverki()
    {
        $this->db->where("period_id", $_POST['start_period_id']);
        $this->db->where("firm_id", $_POST['firm_id']);
        $data['begin_saldo'] = $this->db->get("industry.saldo")->row();

        $this->db->where("period_id", $_POST['finish_period_id']);
        $this->db->where("firm_id", $_POST['firm_id']);
        $data['end_saldo'] = $this->db->get("industry.saldo")->row();

        $this->db->where("id", $_POST['firm_id']);
        $data['firm'] = $this->db->get("industry.firm")->row();

        $this->db->where("id", $_POST['finish_period_id']);
        $data['last_period'] = $this->db->get("industry.period")->row();
        $this->db->where("id", $_POST['start_period_id']);
        $data['first_period'] = $this->db->get("industry.period")->row();

        $sql = "select * from industry.akt_sverki where firm_id={$_POST['firm_id']} and  period_id >={$_POST['start_period_id']} and  period_id<{$_POST['finish_period_id']}";
        $data['akt'] = $this->db->query($sql);
        $data['org_info'] = $this->db->get("industry.org_info")->row();
        $this->load->view('reports/akt_sverki', $data);
    }

    function pre_nakladnaya()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['r'] = $this->db->get('industry.firm');
        $sql = "SELECT period.*,case when sprav.value is not null then 'selected' else '' end  as checked FROM industry.period left join industry.sprav on period.id=sprav.value::integer and sprav.name='current_period' order by id";
        $data['period'] = $this->db->query($sql);
        $this->left();
        $this->load->view("pre_nakladnaya", $data);
        $this->load->view("right");
    }

    function pre_schetfactura()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['r'] = $this->db->get('industry.firm');
        $sql = "SELECT period.*,case when sprav.value is not null then 'selected' else '' end  as checked FROM industry.period left join industry.sprav on period.id=sprav.value::integer and sprav.name='current_period' order by id";
        $data['period'] = $this->db->query($sql);
        $this->left();
        $this->load->view("pre_schetfactura", $data);
        $this->load->view("right");
    }

    function pre_nakladnaya2()
    {
        $data['firm_id'] = $_POST['firm_id'];
        $data['period_id'] = $_POST['period_id'];
        $this->db->where('period_id', $_POST['period_id']);
        $this->db->where('firm_id', $_POST['firm_id']);
        $data['r'] = $this->db->get('industry.schetfactura_date');
        $this->db->where('id', $_POST['firm_id']);
        $data['firm'] = $this->db->get('industry.firm')->row();
        $this->left();
        $this->load->view("pre_nakladnaya2", $data);
        $this->load->view("right");
    }

    function pre_schetfactura2()
    {
        $data['firm_id'] = $_POST['firm_id'];
        $data['period_id'] = $_POST['period_id'];
        $this->db->where('period_id', $_POST['period_id']);
        $this->db->where('firm_id', $_POST['firm_id']);
        $data['r'] = $this->db->get('industry.schetfactura_date');
        $this->db->where('id', $_POST['firm_id']);
        $data['firm'] = $this->db->get('industry.firm')->row();
        $this->left();
        $this->load->view("pre_schetfactura2", $data);
        $this->load->view("right");
    }

    function pre_analiz_mnogourovneviy_spisok()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_analiz_mnogourovneviy_spisok', $data);
        $this->load->view('right');
    }

    function analiz_mnogourovneviy_spisok()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.analiz_mnogourovneviy_spisok");
        $this->load->view("reports/analiz_mnogourovneviy_spisok", $data);
    }

    function pre_analiz_mnogourovneviy()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_analiz_mnogourovneviy', $data);
        $this->load->view('right');
    }

    function analiz_mnogourovneviy()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.analiz_mnogourovneviy");
        $this->load->view("reports/analiz_mnogourovneviy", $data);
    }

    function nakladnaya()
    {
        $this->db->where('id', $_POST['firm_id']);
        $this->db->update('industry.firm',
            array(
                'edit1' => $_POST['edit1'],
                'edit2' => $_POST['edit2'],
                'edit3' => $_POST['edit3'],
                'edit4' => $_POST['edit4'],
                'edit5' => $_POST['edit5'],
                'edit6' => $_POST['edit6']
            )
        );
        $this->load->plugin('chislo');
        $sql = "SELECT * FROM industry.org_info";
        $data['org'] = $this->db->query($sql)->row();
        $sql = "select * from industry.schetfactura where tariff_value<>0 and firm_id=" . $_POST['firm_id'] . ' and period_id=' . $_POST['period_id'];
        $data['s'] = $this->db->query($sql)->result();
        $this->db->where('firm_id', $_POST['firm_id']);
        $this->db->where('period_id', $_POST['period_id']);
        $data['schetfactura_date'] = $this->db->get('industry.schetfactura_date')->row();
        $data['schet_name'] = 'СЧЕТ ФАКТУРА ';
        if (isset($_POST['akt_sverki'])) {
            $data['schet_name'] = 'АКТ ВЫПОЛНЕННЫХ РАБОТ ';
        }
        if (isset($_POST['registr'])) {
            $this->db->where('firm_id', $_POST['firm_id']);
            $this->db->where('period_id', $_POST['period_id']);
            $this->db->update('industry.schetfactura_date',
                array('registered' => 'TRUE', 'data_vydachi' => 'now()')
            );
        }

        $this->db->where('id', $_POST['firm_id']);
        $data['firm'] = $this->db->get('industry.firm')->row();
        $data['edit1'] = $_POST['edit1'];
        $data['edit2'] = $_POST['edit2'];
        $data['edit3'] = $_POST['edit3'];
        $data['edit4'] = $_POST['edit4'];
        $data['edit5'] = $_POST['edit5'];
        $data['edit6'] = $_POST['edit6'];
        $data['data_schet'] = $_POST['data_schet'];

        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get('industry.period')->row();
        $this->db->where('id', $data['firm']->bank_id);
        $data['bank'] = $this->db->get('industry.bank')->row();

        $this->db->where('period_id', $_POST['period_id']);
        $this->db->where('firm_id', $_POST['firm_id']);
        $data['itog'] = $this->db->get("industry.vedomost_itog")->row();

        if (!isset($_POST['html'])) {
            $string = $this->load->view("reports/nakladnaya", $data, TRUE);


            $this->load->library("pdf/pdf");

            $this->pdf->SetSubject('TCPDF Tutorial');
            $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $this->pdf->SetAutoPageBreak(TRUE);
            // set font
            $this->pdf->SetFont('dejavusans', '', 9);

            // add a page
            $this->pdf->AddPage('P');

            $this->pdf->writeHTML($string);

            //Close and output PDF document
            $this->pdf->Output('example_001.pdf', 'I');
        } else {
            $this->load->view("reports/nakladnaya2", $data);
        }
    }


    function schetfactura()
    {/**/
        if (isset($_POST['akt_vypolnenyh_rabot']))
            $data['akt_vypolnenyh_rabot'] = "Акт выполненых работ";
        else
            $data['akt_vypolnenyh_rabot'] = "";
        if (isset($_POST['nakladnaya']))
            $data['nakladnaya'] = "Накладная на отпуск запасов на сторону";
        else
            $data['nakladnaya'] = "СЧЕТ-ФАКТУРА";
        /**/
        $this->db->where('id', $_POST['firm_id']);
        $this->db->update('industry.firm',
            array(
                'edit1' => $_POST['edit1'],
                'edit2' => $_POST['edit2'],
                'edit3' => $_POST['edit3'],
                'edit4' => $_POST['edit4'],
                'edit5' => $_POST['edit5'],
                'edit6' => $_POST['edit6']
            )
        );
        $this->load->plugin('chislo');
        $sql = "SELECT * FROM industry.org_info";
        $data['org'] = $this->db->query($sql)->row();
        $sql = "select * from industry.schetfactura where tariff_value<>0 and firm_id=" . $_POST['firm_id'] . ' and period_id=' . $_POST['period_id'];
        $data['s'] = $this->db->query($sql)->result();
        $this->db->where('firm_id', $_POST['firm_id']);
        $this->db->where('period_id', $_POST['period_id']);
        $data['schetfactura_date'] = $this->db->get('industry.schetfactura_date')->row();
        $data['schet_name'] = 'СЧЕТ ФАКТУРА ';
        if (isset($_POST['akt_sverki'])) {
            $data['schet_name'] = 'АКТ ВЫПОЛНЕННЫХ РАБОТ ';
        }
        if (isset($_POST['registr'])) {
            $this->db->where('firm_id', $_POST['firm_id']);
            $this->db->where('period_id', $_POST['period_id']);
            $this->db->update('industry.schetfactura_date',
                array('registered' => 'TRUE', 'data_vydachi' => 'now()')
            );
        }

        $this->db->where('id', $_POST['firm_id']);
        $data['firm'] = $this->db->get('industry.firm')->row();
        $data['edit1'] = $_POST['edit1'];
        $data['edit2'] = $_POST['edit2'];
        $data['edit3'] = $_POST['edit3'];
        $data['edit4'] = $_POST['edit4'];
        $data['edit5'] = $_POST['edit5'];
        $data['edit6'] = $_POST['edit6'];
        $data['data_schet'] = $_POST['data_schet'];

        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get('industry.period')->row();
        $this->db->where('id', $data['firm']->bank_id);
        $data['bank'] = $this->db->get('industry.bank')->row();

        $this->db->where('period_id', $_POST['period_id']);
        $this->db->where('firm_id', $_POST['firm_id']);
        $data['itog'] = $this->db->get("industry.vedomost_itog")->row();

        if (!isset($_POST['html'])) {
            if (isset($_POST['nakladnaya']))
                $string = $this->load->view("reports/nakladnaya", $data, TRUE);
            else
                $string = $this->load->view("reports/schetfactura", $data, TRUE);


            $this->load->library("pdf/pdf");

            $this->pdf->SetSubject('TCPDF Tutorial');
            $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $this->pdf->SetAutoPageBreak(TRUE);
            // set font
            $this->pdf->SetFont('dejavusans', '', 9);

            // add a page
            $this->pdf->AddPage('P');

            $this->pdf->writeHTML($string);

            //Close and output PDF document
            $this->pdf->Output('example_001.pdf', 'I');
        } else {
            if (isset($_POST['nakladnaya']))
                $this->load->view("reports/nakladnaya2", $data);
            else
                $this->load->view("reports/schetfactura2", $data);
        }
    }

    function pre_schetoplata()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['r'] = $this->db->get('industry.firm');
        $sql = "SELECT period.*,case when sprav.value is not null then 'selected' else '' end  as checked FROM industry.period left join industry.sprav on period.id=sprav.value::integer and sprav.name='current_period' order by id";
        $data['period'] = $this->db->query($sql);
        $this->left();
        $this->load->view("pre_schetoplata", $data);
        $this->load->view("right");
    }

    function pre_schetoplata2()
    {
        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['firm_id'] = $_POST['firm_id'];
        $data['period_id'] = $_POST['period_id'];
        $this->db->where('period_id', $_POST['period_id']);

        $data['r'] = $this->db->get('industry.schetfactura_date');

        $sql = "select distinct tariff_value from industry.schetfactura where  period_id=" . $_POST['period_id'];
        $data['tariffs'] = $this->db->query($sql);

        $this->db->where('id', $_POST['firm_id']);
        $data['firm'] = $this->db->get("industry.firm")->row();
        $this->left();
        $this->load->view("pre_schetoplata2", $data);
        $this->load->view("right");
    }

    function schetoplata()
    {
        $this->db->where('id', $_POST['firm_id']);
        $this->db->update('industry.firm',
            array(
                'edit1' => $_POST['edit1'],
                'edit2' => $_POST['edit2'],
                'edit3' => $_POST['edit3'],
                'edit4' => $_POST['edit4'],
                'edit5' => $_POST['edit5'],
                'edit6' => $_POST['edit6']
            )
        );
        $data['data_start'] = $_POST['data_start'];
        $data['data_finish'] = $_POST['data_finish'];
        $sql = "SELECT * FROM industry.org_info";
        $data['org'] = $this->db->query($sql)->row();
        $this->db->where('firm_id', $_POST['firm_id']);
        $this->db->where('period_id', $_POST['period_id']);
        $data['schetfactura_date'] = $this->db->get('industry.schetfactura_date')->row();
        $data['edit1'] = $_POST['edit1'];
        $data['edit2'] = $_POST['edit2'];
        $data['edit3'] = $_POST['edit3'];
        $data['edit4'] = $_POST['edit4'];
        $data['edit5'] = $_POST['edit5'];
        $data['edit6'] = $_POST['edit6'];
        $this->load->plugin('chislo');
        $this->db->where('id', $_POST['firm_id']);
        $data['firm'] = $this->db->get('industry.firm')->row();

        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get('industry.period')->row();

        $this->db->where('id', $data['firm']->bank_id);
        $data['bank'] = $this->db->get("industry.bank")->row();
        $data['schet'] = !isset($_POST['schet']) ? " НА ОПЛАТУ" : "-ФАКТУРА";


        if ($_POST['type'] == "by_tenge") {
            $tariff_value = $_POST['tariff_value'];
            $tariff_kvt = $_POST['tariff'];
            $buf;
            for ($j = 0; $j < $_POST['tariff_count']; $j++) {
                if ($tariff_value[$j] > 0)
                    $buf[$j] = $tariff_kvt[$j] / $tariff_value[$j] / ((100 + $data['period']->nds) / 100);
                else
                    $buf[$j] = $tariff_kvt[$j];
            }
            $data['tariff_kvt'] = $buf;
        } else
            $data['tariff_kvt'] = $_POST['tariff'];
        $data['tariff_value'] = $_POST['tariff_value'];
        $data['tariff_count'] = $_POST['tariff_count'];
        $data['data_schet'] = $_POST['data_schet'];

        if (isset($_POST['schet2'])) {
            if (isset($_POST['schet2full'])) {
                $data["full"] = "true";
            } else {
                $data["full"] = "false";
            }
            $this->load->view("reports/schetoplata2", $data);
        } else
            $this->load->view("reports/schetoplata", $data);
    }

    function akt()
    {
        $query = "SELECT * FROM industry.current_akt WHERE values_set_id=" . $this->uri->segment(3);
        $data['query'] = $this->db->query($query);
        $this->load->view("akt_view", $data);
        $this->execute("add_akt");
    }

    function delete_akt()
    {
        $id = $this->db->query("select values_set_id from industry.akt where id=" . $this->uri->segment(3))->row()->values_set_id;
        $this->db->query("delete from industry.akt where id=" . $this->uri->segment(3));
        redirect("billing/values_sets/" . $id);
    }

    function add_akt()
    {
        $data['vs_id'] = $this->uri->segment(3);
        $this->load->view("add_akt", $data);
    }

    function adding_akt()
    {

        $_POST['tariff_value'] = 4;
        $this->db->insert("industry.akt", $_POST);
        redirect("billing/values_sets/" . $_POST['values_set_id']);
    }

    function edit_pokaz()
    {
        $this->left();
        $sql = "SELECT * FROM industry.counter_add_pokaz where firm_id=" . $this->uri->segment(3);
        $data['firm_id'] = $this->uri->segment(3);
        $data['pokaz'] = $this->db->query($sql);
        $this->load->view("edit_pokaz", $data);
        $this->load->view("right");
    }

    function delete_pokazanie2()
    {
        $query = $this->db->query("select * from industry.counter_value where id=" . $this->uri->segment(3));
        $id = $query->row()->values_set_id;
        $query = $this->db->query("select distinct firm_id from industry.counter_add_pokaz where values_set_id=$id");
        $firm_id = $query->row()->firm_id;
        $this->db->query("delete from industry.counter_value where id=" . $this->uri->segment(3));
        redirect("billing/edit_pokaz/$firm_id#$id");
    }

    function adding_pokazanie2()
    {
        $sql = "SELECT firm_id from industry.firmid_by_values_set where values_set_id=" . $_POST['values_set_id'];
        $w = $this->db->query($sql)->row()->firm_id;

        $this->session->set_userdata(array('day' => $_POST['day'], 'month' => $_POST['month'], 'year' => $_POST['year']));
        $data = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
        if (!checkdate($_POST['month'], $_POST['day'], $_POST['year'])) {
            redirect("billing/edit_pokaz/" . $w);
        }
        $_POST['data'] = date("Y-m-d", mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
        unset($_POST['year']);
        unset($_POST['day']);
        unset($_POST['month']);
        $_POST['uroven'] = 0;
        $this->db->insert("industry.counter_value", $_POST);

        redirect("billing/edit_pokaz/$w#" . ($this->uri->segment(3) + 1));
    }

    //! Отчеты
    function reports()
    {
        $this->left();
        $this->load->view("reports");
        $this->load->view("right");
    }

    function vih_7_re_form()
    {
        $sql = "SELECT * from industry.period order by id";
        $data['periods'] = $this->db->query($sql);
        $this->left();
        $this->load->view("reports/form/vih_7_re_form", $data);
        $this->load->view("right");
    }

    function vih_7_re()
    {
        $data['org_info'] = $this->db->get("industry.org_info")->row();
        $sql = 'select * from industry.period where id=' . $_POST['period_id'];
        $data['period'] = $this->db->query($sql)->row();
        $sql = 'select * from industry."7-re" where period_id=' . $_POST['period_id'];
        if ($_POST['type'] == 2) {
            $sql .= " and 
			coalesce(\"7-re\".debet_value,0) - 
			coalesce(\"7-re\".kredit_value,0)	+
			coalesce(\"7-re\".nachisleno,0) -
			coalesce(\"7-re\".oplata_value,0)>0 ";
        }
        if ($_POST['type'] == 3) {
            $sql .= " and 
			coalesce(\"7-re\".debet_value,0) - 
			coalesce(\"7-re\".kredit_value,0)	+
			coalesce(\"7-re\".nachisleno,0) -
			coalesce(\"7-re\".oplata_value,0)<0 ";
        }
        $data['sql_result'] = $this->db->query($sql);
        $this->load->view("reports/7-re", $data);
    }

    function vih_2_re()
    {
        $data['org_info'] = $this->db->get("industry.org_info")->row();
        $sql = 'select * from industry.period where id=' . $_POST['period_id'];
        $data['period'] = $this->db->query($sql)->row();
        $sql = 'select * from industry."2-re" where period_id=' . $_POST['period_id'];
        $data['sql_result'] = $this->db->query($sql);
        $this->load->view("reports/2-re", $data);
    }

    function vih_2_re_form()
    {
        $sql = "SELECT * from industry.period order by id";
        $data['periods'] = $this->db->query($sql);
        $this->left();
        $this->load->view("reports/form/vih_2_re_form", $data);
        $this->load->view("right");
    }

    function vih_analiz_kredit_debit()
    {
        $sql = 'select * from industry.analiz_of_change_debet_kredit where period_id=4';
        $data['analiz'] = $this->db->query($sql)->result();
        $this->load->view('reports/analiz_of_change_debet_kredit', $data);
    }

    function rashod_electro()
    {
        $sql = "SELECT * FROM industry.firm where id=" . $this->uri->segment(3);
        $data['firm_data'] = $this->db->query($sql)->row();
        $sql = "SELECT * FROM industry.rashod_electro where firm_id=" . $this->uri->segment(3);
        $data['points_data'] = $this->db->query($sql);
        $this->load->view('reports/rashod_electro', $data);
    }

    function counters_by_type()
    {
        $sql = "select * from industry.counters_by_type where counter_data_finish is null order by counter_type_id,ture_id,dogovor";
        $data['counters'] = $this->db->query($sql);
        $this->load->view('reports/counters_by_type', $data);
    }

    function reported_firms_form()
    {
        $this->db->order_by("id");
        $data['ture'] = $this->db->get("industry.ture");
        $this->left();
        $this->load->view("reports/form/reported_firms_form", $data);
        $this->load->view("right");
    }

    function reported_firms()
    {
        $this->db->where('id', $_POST['ture_id']);
        $data["ture"] = $this->db->get('industry.ture')->row();
        $sql = "select * from industry.reported_firms where firm_close_id is " . (!$_POST['reported_or_notreported'] ? " not " : "") . " null and ture_id=" . $_POST['ture_id'] . "  order by dogovor";
        $data['type'] = $_POST['reported_or_notreported'];
        $data['firms'] = $this->db->query($sql);
        $this->load->view('reports/reported_firms', $data);
    }

    function pre_dolgi()
    {
        $this->db->order_by("id");
        $data['ture'] = $this->db->get("industry.ture");
        $this->left();
        $this->load->view("pre_dolgi", $data);
        $this->load->view("right");
    }

    function dolgi()
    {
        $data['we'] = $this->db->get("industry.org_info")->row();
        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->db->order_by("dogovor");
        $this->db->where("dolg::numeric(24,2)>", 0);
        $this->db->where("firm_ture_id", $_POST['ture_id']);
        $data['firms'] = $this->db->get('industry.dolgi');

        $this->db->where("id", $_POST['ture_id']);
        $data['ture'] = $this->db->get('industry.ture')->row();
        if (isset($_POST['another'])) {
            $this->load->view('reports/dolgi2', $data);
        } else {
            $this->load->view('reports/dolgi', $data);
        }
    }

    function pre_snyatie_counter_value()
    {
        $this->db->order_by("id");
        $data['ture'] = $this->db->get("industry.ture");
        $this->left();
        $this->load->view("reports/form/snyatie_counter_value", $data);
        $this->load->view("right");
    }

    function snyatie_counter_value()
    {
        $data['we'] = $this->db->query("select * from industry.org_info")->row();
        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->db->where('id', $_POST['ture_id']);
        $data['values'] = $this->db->get("industry.snyatie_counter_value");
        $this->load->view('reports/snyatie_counter_value', $data);
    }

    function list_of_firms()
    {
        $sql = "select * from industry.list_of_firms";
        $data['firms'] = $this->db->query($sql);

        $this->load->view('reports/list_of_firms', $data);
    }

    function user_list()
    {
        $data['users'] = $this->db->get('industry.user');
        $this->load->view("user_list", $data);
    }

    function oborotka()
    {
        $this->db->where('firm_id', $this->uri->segment(3));
        $data['oborotka'] = $this->db->get('industry.oborotka')->row();
        $this->left();
        $this->load->view("oborotka", $data);
        $this->load->view("right");
    }

    function firm_oplata()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['firm'] = $this->db->get('industry.firm')->row();
        $this->db->where('firm_id', $this->uri->segment(3));
        $this->db->order_by("data", "desc");
        $data['firm_oplata'] = $this->db->get('industry.firm_oplata')->result();
        $this->left();
        $this->load->view("firm_oplata", $data);
        $this->load->view("right");
    }

    function delete_values_set()
    {
        $this->db->query("delete from industry.values_set where id=" . $this->uri->segment(3));
        redirect("billing/counter/" . $this->uri->segment(4));
    }

    function delete_counter_close()
    {
        $this->db->query("select industry.delete_counter_close('{$this->uri->segment(3)}');");
        redirect("billing/point/" . $this->uri->segment(4));
    }

    function delete_counter()
    {
        $sql = "select point_id from industry.counter where id=" . $this->uri->segment(3);
        $point_id = $this->db->query($sql)->row()->point_id;
        $sql = "select industry.delete_counter(" . $this->uri->segment(3) . ") as is_deleted;";
        $is_deleted = $this->db->query($sql)->row()->is_deleted;
        $this->session->set_flashdata('is_deleted', $is_deleted);
        redirect("billing/point/" . $point_id);
    }

    function delete_billing_point()
    {
        $sql = "select firm_id from industry.billing_point where id=" . $this->uri->segment(3);
        $firm_id = $this->db->query($sql)->row()->firm_id;
        $sql = "select count(*) as count from industry.counter where point_id=" . $this->uri->segment(3);
        $count = $this->db->query($sql)->row()->count;
        if ($count == 0) {
            $count = -1;
            $sql = "delete from industry.billing_point where id=" . $this->uri->segment(3);
            $this->db->query($sql);
        }

        $this->session->set_flashdata('is_deleted', $count);
        redirect("billing/firm/" . $firm_id);
    }

    function edit_billing_point()
    {
        $this->db->where('id', $this->uri->segment(3));
        $data['point'] = $this->db->get('industry.billing_point')->row();
        $data['tp'] = $this->db->get('industry.tp');
        $data['power_group'] = $this->db->get('industry.firm_power_group');
        $data['point_id'] = $this->uri->segment(3);
        $this->left();
        $this->load->view('edit_billing_point', $data);
        $this->load->view('right');
    }

    function edition_billing_point()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->update('industry.billing_point', $_POST);
        redirect("billing/edit_billing_point/" . $this->uri->segment(3));
    }

    function edit_permission()
    {
        $sql = "select * from industry.user where id=" . $this->uri->segment(3);
        $data['perm'] = $this->db->query($sql)->row_array();
        $this->left();
        $this->load->view('edit_permission', $data);
        $this->load->view("right");
    }

    function edition_permission()
    {
        $sql = "select * from industry.user where id=" . $_POST['id'];
        $perm = $this->db->query($sql)->row_array();
        $this->db->where('id', $_POST['id']);
        unset($perm['id']);
        unset($perm['password']);
        foreach ($perm as $key => $_f) {
            if (($key != 'name') and ($key != 'login') and ($key != 'profa')) {
                if (isset($_POST[$key]))
                    $f[$key] = 't';
                else $f[$key] = 'f';
            }
        }
        $this->db->update('industry.user', $f);
        redirect('billing/edit_permission/' . $_POST['id']);
    }

    //! DBASE для работы с DBF
    function to_date($var)
    {
        $year = substr($var, 0, 4);
        $month = substr($var, 4, 2);
        $day = substr($var, 6, 2);
        return $day . "." . $month . "." . $year;
    }

    function dbase()
    {
        $this->db->query("delete from industry.oplata_buf");
        $period = $this->db->query("select * from industry.period where 
			id in 	(select value::integer from industry.sprav	where name='current_period')")->row();
        $sql = "";
        set_time_limit(0);
        $db = dbase_open("c:/oplata/OPLATA.dbf", 0);

        if ($db) {
            for ($i = 1; $i < dbase_numrecords($db) + 1; $i++) {
                $rec = dbase_get_record_with_names($db, $i);

                $year = substr($rec['DATA'], 0, 4);
                $month = substr($rec['DATA'], 4, 2);
                $day = substr($rec['DATA'], 6, 2);

                $data = mktime(0, 0, 0, $month, $day, $year);
                $data = date("Y-m-d", $data);
                if (($data >= $period->begin_date) and ($data <= $period->end_date)) {
                    $rec['DATA'] = $this->to_date($rec['DATA']);
                    $rec['DATA_V'] = $this->to_date($rec['DATA_V']);

                    if (strlen(trim($rec['VO'])) == 0) $rec['VO'] = 0;

                    $sql .= "\nINSERT INTO industry.oplata_buf(
					 data, un_nom, dog, data_v, n_dokum, sum, schet, vo) values 
					 ('{$rec['DATA']}',{$rec['UN_NOM']},{$rec['DOG']},
					 '{$rec['DATA_V']}',{$rec['N_DOKUM']},{$rec['SUM']},
					 '{$rec['SCHET']}',{$rec['VO']});\n";
                }
            }
            dbase_close($db);

            $this->db->query($sql);

            $d["d"] = $this->db->get('industry.oplata_unknown_dogovor');
            $d["s"] = $this->db->get('industry.oplata_unknown_schet');
            $this->load->view("oplata/import", $d);
        } else
            echo "База не открыта";
    }

    function oplata_import()
    {
        $this->db->query(
            "
		delete from industry.oplata where data between  
		   (select period.begin_date from industry.period
                 left join industry.sprav on sprav.name='current_period'
					where period.id=sprav.value) 
					 and (select period.end_date from industry.period
                 left join industry.sprav on sprav.name='current_period'
					where period.id=sprav.value) ;
		insert into industry.oplata 
			(firm_id,data,document_number,payment_number_id,value,nds)
			select industry.firm_id_by_dogovor(dog) as firm_id,data,n_dokum, industry.schet_id_by_name(schet),
			sum/(1+industry.current_nds()/100),industry.current_nds() from industry.oplata_buf 
			where industry.firm_id_by_dogovor(dog) is not null and industry.schet_id_by_name(schet) is not null"
        );
        redirect("billing");
    }

    function jpeg()
    {

    }

    function gd_info()
    {
        gd_info();
    }

    function com()
    {
        $xls = new COM("Excel.Application");
        $xls->Application->Visible = 1;
        $xls->Workbooks->Add();
        $range = $xls->Range("A1");
        $range->Value = "Проба записи";
        // Сохраняем документ
        $xls->Workbooks[1]->SaveAs("c:/test.xls");
        $xls->Quit();
        $xls->Release();
        $xls = Null;
        $range = Null;
        echo "Hello";
    }

    function change_password()
    {
        $this->left();
        $this->load->view('sprav/change_password');
        $this->load->view('right');
    }

    function changing_password()
    {
        $sql = "select * from industry.user where login='{$this->session->userdata('login')}' and password=md5('{$_POST['old_pass']}')";
        $count = $this->db->query($sql)->num_rows();
        if ($count > 0) {
            if ($_POST['new_pass_1'] == $_POST['new_pass_2']) {
                $this->db->where('id', $this->session->userdata('id'));
                $this->db->update('industry.user', array('password' => md5($_POST['new_pass_1'])));
                $this->session->set_flashdata('ischanged', 'yes');
            } else
                $this->session->set_flashdata('ischanged', 'not_ident');
        } else $this->session->set_flashdata('ischanged', 'old_pass_error');
        redirect('billing/change_password');
    }

    // работа с оплатой

    function org_info()
    {
        $this->left();
        $data['org_info'] = $this->db->get("industry.org_info")->row();
        $this->load->view('sprav/org_info', $data);
        $this->load->view('right');
    }

    function changing_org_info()
    {
        $this->db->update('industry.org_info', $_POST);
        $this->session->set_flashdata('is_changed', 'изменено');
        redirect("billing/org_info");
    }

    function pre_oplata_info()
    {
        $this->left();
        $this->load->view('pre_oplata_info');
        $this->load->view('right');
    }

    function oplata_info()
    {
        $sql = "select * from industry.oplata_info where oplata_data between '{$_POST['begin_date']}' and '{$_POST['end_date']}';";
        $data['oplata_info'] = $this->db->query($sql);
        $this->load->view('reports/oplata_info', $data);
    }


    function oplata()
    {
        if ($this->session->userdata('begin_data') == "") {
            $sql = "select period.* from industry.period 
					left join industry.sprav on sprav.name='current_period'
						where period.id=sprav.value";
            $period = $this->db->query($sql)->row();
            $this->session->set_userdata(array('begin_data' => $period->begin_date, 'end_data' => $period->end_date));
        }
        $sql = "select * from industry.oplata_edit where data between '" . $this->session->userdata('begin_data') . "' and '" . $this->session->userdata('end_data') . "'";
        $data['oplata'] = $this->db->query($sql);
        $this->load->view('oplata/index', $data);
    }

    function oplata_po_schetam()
    {
        if (!isset($_POST['start'])) {
            $this->db->where('period_id', $_POST['period_id']);
            $data['oplata'] = $this->db->get('industry.oplata_po_schetam');
        } else {
            $sql = "select * from industry.oplata_po_schetam where data between '{$_POST['start']}' and 
								'{$_POST['end']}'";
            $data['oplata'] = $this->db->query($sql);
        }

        $this->load->view("oplata/po_schetam", $data);
    }

    function oplata_svod()
    {
        $this->db->where('period_id', $_POST['period_id']);
        $data['oplata'] = $this->db->get("industry.oplata_svod");
        $this->load->view('oplata/svod', $data);
    }

    function pre_oplata_svod()
    {
        $this->db->order_by("id");
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view("pre_oplata_svod", $data);
        $this->load->view("right");
    }

    function pre_oplata_po_schetam()
    {
        $this->db->order_by("id");
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view("pre_oplata_po_schetam", $data);
        $this->load->view("right");
    }

    function change_oplata_period()
    {
        $this->session->set_userdata($_POST);
        redirect('billing/oplata');
    }

    function adding_oplata()
    {

        $sql = "select count(*) from industry.firm where dogovor=" . $_POST['dogovor'];
        $count = $this->db->query($sql)->row()->count;

        $sql = "select id,name from industry.firm where dogovor=" . $_POST['dogovor'];
        $query = $this->db->query($sql);
        if ($count > 0) {
            $firm_id = $this->db->query($sql)->row()->id;
            $firm_name = $this->db->query($sql)->row()->name;
            $data['firm_id'] = $firm_id;
            $data['nds'] = $_POST['nds'];
            $data['is_prochee'] = $_POST['is_prochee'];
            $data['is_akt'] = $_POST['is_akt'];
            $sql = "select count(*)  from industry.payment_number where number='" . $_POST['payment_number'] . "'";
            $count = $this->db->query($sql)->row()->count;
            $sql = "select id from industry.payment_number where number='" . $_POST['payment_number'] . "'";
            echo $sql;
            $query = $this->db->query($sql);
            if ($count > 0) {
                $data['payment_number_id'] = $query->row()->id;
                $this->session->set_userdata(
                    array('data' => $_POST['data'],
                        'number' => $_POST['payment_number']
                    )
                );
                $data['value'] = $_POST['value'] / 1.12;
                $data['data'] = $_POST['data'];

                $data['document_number'] = $_POST['document_number'];
                $this->db->insert('industry.oplata', $data);
                $this->session->set_flashdata('added', 'true');
                $this->session->set_flashdata('firm_name', $firm_name);

            }
        }
        redirect('billing/oplata');
    }

    function pre_svod_po_tp()
    {
        $data['ture'] = $this->db->get("industry.ture");
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_svod_po_tp', $data);
        $this->load->view('right');
    }

    function svod_po_tp()
    {

        $this->load->library("pdf/pdf");

        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $this->pdf->SetAutoPageBreak(TRUE);
        // set font
        $this->pdf->SetFont('dejavusans', '', 7);

        // add a page
        $this->pdf->AddPage();
        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get('industry.period');
        $this->db->where('ture_id', $_POST['ture_id']);
        $this->db->where('period_id', $_POST['period_id']);
        $data['ture'] = $this->db->get('industry.svod_po_tp');
        $string = $this->load->view("reports/svod_po_tp", $data, TRUE);

        $this->pdf->writeHTML($string);

        //Close and output PDF document
        $this->pdf->Output('example_001.pdf', 'I');
    }

    function pre_svod_saldo_po_ture()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_svod_saldo_po_ture', $data);
        $this->load->view('right');
    }

    function svod_saldo_po_ture()
    {
        $this->load->library("pdf/pdf");


        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->db->where('period_id', $_POST['period_id']);
        $data['ture'] = $this->db->get('industry.svod_saldo_po_ture');
        $string = $this->load->view("reports/svod_saldo_po_ture", $data, TRUE);

        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set font
        $this->pdf->SetFont('dejavusans', '', 10);

        // add a page
        $this->pdf->AddPage();
        $this->pdf->writeHTML($string);

        //Close and output PDF document
        $this->pdf->Output('example_001.pdf', 'I');
    }

    function pre_energo_24()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_energo_24', $data);
        $this->load->view('right');
    }

    function energo_24()
    {
        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->db->where('period_id', $_POST['period_id']);
        $data['energo'] = $this->db->get('industry.energo_24');
        $this->load->view('reports/energo_24', $data);
    }

    function pre_schetfactura_jurnal()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_schetfactura_jurnal', $data);
        $this->load->view('right');
    }

    function schetfactura_jurnal()
    {
        $data['period_name'] = $this->db->query("select name as current_period from industry.period where id=" . $_POST['period_id'])->row();
        $this->db->where('period_id', $_POST['period_id']);
        $data['jurnal'] = $this->db->get('industry.schetfactura_jurnal');
        $this->load->view('reports/schetfactura_jurnal', $data);
    }

    function naryad_zadanie_po_ture()
    {
        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->db->where('ture_id', $_POST['ture_id']);
        //$this->db->where('phase',$_POST['phase']);

        $data['naryad'] = $this->db->get('industry.naryad_zadanie_po_ture');
        $this->load->view('reports/naryad_zadanie_po_ture', $data);
    }

    function pre_naryad_zadanie_po_ture()
    {
        $data['ture'] = $this->db->get("industry.ture");
        $this->left();
        $this->load->view('pre_naryad_zadanie_po_ture', $data);
        $this->load->view('right');
    }

    function pre_oborotka_with_predoplata()
    {
        $data['ture'] = $this->db->get("industry.ture");
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_oborotka_with_predoplata', $data);
        $this->load->view('right');
    }

    function oborotka_with_predoplata()
    {
        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get('industry.period')->row();
        $this->db->where('period_id', $_POST['period_id']);
        $this->db->where('firm_ture_id', $_POST['ture_id']);

        $data['oborotka'] = $this->db->get("industry.oborotka_with_predoplata");
        $this->load->view('reports/oborotka_with_predoplata', $data);
    }

    function pre_svod_oplat_po_firmam()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_svod_oplat_po_firmam', $data);
        $this->load->view('right');
    }

    function svod_oplat_po_firmam()
    {
        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $this->db->order_by('dogovor');
        $this->db->where('period_id', $_POST['period_id']);
        $data['svod'] = $this->db->get("industry.svod_oplat_po_firmam");
        $this->load->view('reports/svod_oplat_po_firmam', $data);
    }

    function pre_poleznyy_otpusk()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_poleznyy_otpusk', $data);
        $this->load->view('right');
    }

    function poleznyy_otpusk()
    {
        $data['org_info'] = $this->db->get('industry.org_info')->row();
        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->db->where('period_id', $_POST['period_id']);
        if ($_POST['type'] == 1) {
            $data['otpusk'] = $this->db->get('industry.poleznyy_otpusk');
        }
        if ($_POST['type'] == 2) {
            $this->db->where('is_too', 'TRUE');
            $data['otpusk'] = $this->db->get('industry.poleznyy_otpusk_is_too');
        }
        if ($_POST['type'] == 3) {
            $this->db->where('is_too', 'FALSE');
            $data['otpusk'] = $this->db->get('industry.poleznyy_otpusk_is_too');
        }
        $data['type'] = $_POST['type'];
        $data['podpis'] = $_POST['podpis'];
        $this->load->view('reports/poleznyy_otpusk', $data);
    }

    function copy_user()
    {
        $this->db->where('id', '7');
        $user = $this->db->get("industry.user")->row_array();
        unset($user['id']);
        unset($user['name']);
        $this->db->insert('industry.user', $user);
    }

    function pre_perehod()
    {
        $this->left();
        $this->load->view('pre_perehod');
        $this->load->view('right');
    }

    function perehod()
    {
        $this->db->query("select industry.goto_next_period();");
        redirect("billing");
    }

    function oplata_delete()
    {
        $sql = "delete from industry.oplata where id=" . $this->uri->segment(3);
        $this->db->query($sql);
        redirect('billing/oplata');
    }

    function pre_nds_export()
    {
        $sql = "SELECT value::integer as current_period FROM industry.sprav WHERE name='current_period'";
        $data['current_period'] = $this->db->query($sql)->row()->current_period;
        $data['period'] = $this->db->get('industry.period');
        $this->left();
        $this->load->view("pre_nds_export", $data);
        $this->load->view("right");
    }

    function nds_export()
    {
        $sql = "select * from industry.export_nds where  period_id 
		  between '{$_POST['start_period_id']}'
		  and '{$_POST['finish_period_id']}' ";
        $data['firms'] = $this->db->query($sql);
        $this->load->view("reports/nds_export", $data);
    }

    function statisticheskiy_otchet()
    {
        $data['otchet'] = $this->db->get("industry.statisticheskiy_otchet");
        $data['period_name'] = $this->db->query("select industry.current_period() as current_period")->row();
        $this->load->view("reports/statisticheskiy_otchet", $data);
    }

    function pre_diff_tariff_controll()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_diff_tariff_controll', $data);
        $this->load->view('right');
    }

    function diff_tariff_controll()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.diff_tariff_controll");
        $this->load->view("reports/diff_tariff_controll", $data);
    }

    function pre_diff_tariff_spisok()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_diff_tariff_spisok', $data);
        $this->load->view('right');
    }

    function diff_tariff_spisok()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.diff_tariff_spisok");
        $this->load->view("reports/diff_tariff_spisok", $data);
    }

    function pre_diff_tariff_controll_3()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_diff_tariff_controll_3', $data);
        $this->load->view('right');
    }

    function diff_tariff_controll_3()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.diff_tariff_controll_3");
        $this->load->view("reports/diff_tariff_controll_3", $data);
    }

    function pre_diff_tariff_spisok_3()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_diff_tariff_spisok_3', $data);
        $this->load->view('right');
    }

    function diff_tariff_spisok_3()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.diff_tariff_spisok_3");
        $this->load->view("reports/diff_tariff_spisok_3", $data);
    }

    function pre_multi_tariff_count()
    {
        $data['ture'] = $this->db->get("industry.ture");
        $this->left();
        $this->load->view('pre_multi_tariff_count', $data);
        $this->load->view('right');
    }

    function multi_tariff_count()
    {
        $this->db->where('id', $_POST['ture_id']);
        $data['ture'] = $this->db->get('industry.ture')->row();
        $this->db->where('ture_id', $_POST['ture_id']);
        $data['firms'] = $this->db->get("industry.multi_tariff_count");
        $this->load->view('reports/multi_tariff_count', $data);
    }

    function schetfactura_numbers()
    {
        $this->left();
        $this->db->where('firm_id', $this->uri->segment(3));
        $data['numbers'] = $this->db->get('industry.schetfactura_numbers');
        $this->load->view('schetfactura_numbers', $data);
        $this->load->view('right');
    }

    function pre_svod()
    {
        $data['period'] = $this->db->get('industry.period');
        $this->left();
        $this->load->view("pre_svod", $data);
        $this->load->view("right");
    }

    function svod()
    {
        $sql = "";
        $params = 'firm.name as firm_name ';
        $php = 'echo "<tr><td>".$j++."</td><td>".$r->firm_name."</td>";';
        $period_head = "<tr><td>№</td><td>Предприятие</td>";
        for ($j = $_POST['start_period_id']; $j <= $_POST['finish_period_id']; $j++) {
            $tablename = "\"" . $j . "\"";
            $columnname = "\"col_" . $j . "\"";
            $sql .= " left join industry.\"7-re\" as $tablename 
				on $tablename.period_id=$j and $tablename.firm_id=firm.id ";
            $params .= ", coalesce($tablename.itogo_kvt,0) as $columnname ";
            $php .= 'echo "<td align=right>$r->col_' . $j . '</td>";';
            $this->db->where('id', $j);
            $period_head .= "<td>" . $this->db->get('industry.period')->row()->name . "</td>";
        }
        $sql = "select $params from industry.firm " . $sql . " order by firm.dogovor";
        $data['res'] = $this->db->query($sql);
        $data['php'] = $php;
        $data['period_head'] = $period_head;
        $this->load->view("reports/svod", $data);
    }

    function pre_poleznyy_otpusk2()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_poleznyy_otpusk2', $data);
        $this->load->view('right');
    }

    function poleznyy_otpusk2()
    {
        $data['org_info'] = $this->db->get('industry.org_info')->row();
        $this->db->where('id', $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period");
        $this->db->where('period_id', $_POST['period_id']);
        $data['otpusk'] = $this->db->get('industry.poleznyy_otpusk2');
        $this->load->view('reports/poleznyy_otpusk2', $data);
    }

    function pre_analiz_diff_tarif()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_analiz_diff_tarif', $data);
        $this->load->view('right');
    }

    function analiz_diff_tarif()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.analiz_diff_tarif");
        $this->load->view("reports/analiz_diff_tarif", $data);
    }

    function pre_analiz_diff_tarif_spisok()
    {
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view('pre_analiz_diff_tarif_spisok', $data);
        $this->load->view('right');
    }

    function analiz_diff_tarif_spisok()
    {
        $this->db->where("id", $_POST['period_id']);
        $data['period'] = $this->db->get("industry.period")->row();
        $data['org'] = $this->db->get("industry.org_info")->row();
        $this->db->where("period_id", $_POST['period_id']);
        $data['diff'] = $this->db->get("industry.analiz_diff_tarif_spisok");
        $this->load->view("reports/analiz_diff_tarif_spisok", $data);
    }

    function pre_nachislenie_v_analiz()
    {
        $this->db->order_by("id");
        $data['period'] = $this->db->get("industry.period");
        $this->left();
        $this->load->view("pre_nachislenie_v_analiz", $data);
        $this->load->view("right");
    }

    function shortdate($date)
    {
        $d = explode("-", $date);
        return $d['1'] . '.' . substr($d['0'], 2, 2);
    }

    function f_d_graph($var)
    {
        if ($var == 0) return "0"; else
            return trim(sprintf("%22.2f", $var));
    }

    function pre_graph()
    {
        $sql = "SELECT value::integer as current_period FROM industry.sprav WHERE name='current_period'";
        $data['current_period'] = $this->db->query($sql)->row()->current_period;

        $this->db->order_by("id");
        $data['period'] = $this->db->get("industry.period");
        $data['firm_id'] = $this->uri->segment(3);
        $this->left();
        $this->load->view('pre_graph', $data);
        $this->load->view('right');
    }

    function closer_number($max)
    {
        $p = 1;
        $pow = 1;
        $pow2 = 100;
        while ($p < $max) {
            $pow = $pow * 10;
            $pow2 = $pow * 10;
            $p = $pow;
            while (($pow2 > $p) and ($max > $p)) {
                $p += $pow;
            }
        }
        $p += $pow;
        $numbers = "0";
        for ($j = 1; $j < 11; $j++) {
            $numbers .= ", " . $this->f_d_graph($p * $j / 10);
        }
        return $numbers;
    }

    function graph()
    {
        $periods = "";
        $i = "";
        $fi = $_POST["start_period_id"];
        $ei = $_POST["finish_period_id"];
        $first = 1;
        $sql = "select * from industry.graph where firm_id ={$this->uri->segment(3)} and period_id between $fi and $ei";

        $this->db->where("id", $this->uri->segment(3));
        $data['firm_info'] = $this->db->get("industry.firm")->row();
        $res = $this->db->query($sql);
        $max = 0;
        foreach ($res->result() as $p) {
            if ($max < $p->itogo_kvt) {
                $max = $p->itogo_kvt;
            }
            if ($first == 1) {
                $periods .= "'" . $this->shortdate($p->period_begin_date) . "'";
                $i .= $this->f_d_graph($p->itogo_kvt);
                $first = 2;
            } else {
                $periods .= ", '" . $this->shortdate($p->period_begin_date) . "' ";
                $i .= ', ' . $this->f_d_graph($p->itogo_kvt);
            }
        }


        $data['periods'] = $periods;
        $data['itogo_kvt'] = $i;
        $data['numbers'] = $this->closer_number($max);
        $this->load->view('reports/graph', $data);
    }

    function nachislenie_v_analiz()
    {
        $this->db->where("period_id", $_POST['period_id']);
        $nach = $this->db->get("industry.analiz_po_tp");

        set_time_limit(0);
        $db = dbase_open("c:/oplata/anal_tp.dbf", 2);

        if ($db) {
            for ($i = 1; $i < dbase_numrecords($db) + 1; $i++) {
                dbase_delete_record($db, $i);
            }
            dbase_pack($db);
            dbase_close($db);

            $db2 = dbase_open("c:/oplata/anal_tp.dbf", 2);
            foreach ($nach->result() as $n) {
                dbase_add_record($db2,
                    array(
                        $n->ture_id,
                        iconv("utf-8", "windows-1251", $n->tp_name),
                        $n->kvt, 0, 0
                    )
                );
            }

            dbase_close($db2);
        } else
            echo "База не открыта";
        redirect("billing");
    }
}

?>