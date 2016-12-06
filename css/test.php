 if ($this->input->post('first_quart_logo')) {
            $quart['first_quart_logo'] = $this->input->post('first_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['first_quart']);
            $quart['first_quart'] = @$quart1[0];
            $quart['first_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('second_quart_logo')) {
            $quart['second_quart_logo'] = $this->input->post('second_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['second_quart']);
            $quart['second_quart'] = @$quart1[0];
            $quart['second_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('third_quart_logo')) {
            $quart['third_quart_logo'] = $this->input->post('third_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['third_quart']);
            $quart['third_quart'] = @$quart1[0];
            $quart['third_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('fourth_quart_logo')) {
            $quart['fourth_quart_logo'] = $this->input->post('fourth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['fourth_quart']);
            $quart['fourth_quart'] = @$quart1[0];
            $quart['fourth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('fifth_quart_logo')) {
            $quart['fifth_quart_logo'] = $this->input->post('fifth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['fifth_quart']);
            $quart['fifth_quart'] = @$quart1[0];
            $quart['fifth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('sixth_quart_logo')) {
            $quart['sixth_quart_logo'] = $this->input->post('sixth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['sixth_quart']);
            $quart['sixth_quart'] = @$quart1[0];
            $quart['sixth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('seventh_quart_logo')) {
            $quart['seventh_quart_logo'] = $this->input->post('seventh_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['seventh_quart']);
            $quart['seventh_quart'] = @$quart1[0];
            $quart['seventh_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('eighth_quart_logo')) {
            $quart['eighth_quart_logo'] = $this->input->post('eighth_quart_logo');
        } else {
            @$quart1 = explode('$$', $quart['eighth_quart']);
            $quart['eighth_quart'] = @$quart1[0];
            $quart['eighth_quart_logo'] = @$quart1[1];
        }
        if ($this->input->post('first_semi_logo')) {
            $semi['first_semi_logo'] = $this->input->post('first_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['first_semi_logo']);
            $semi['first_semi'] = @$quart1[0];
            $semi['first_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('second_semi_logo')) {
            $semi['second_semi_logo'] = $this->input->post('second_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['second_semi_logo']);
            $semi['second_semi'] = @$quart1[0];
            $semi['second_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('third_semi_logo')) {
            $semi['third_semi_logo'] = $this->input->post('third_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['third_semi_logo']);
            $semi['third_semi'] = @$quart1[0];
            $semi['third_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('fourth_semi_logo')) {
            $semi['fourth_semi_logo'] = $this->input->post('fourth_semi_logo');
        } else {
            @$quart1 = explode('$$', $semi['fourth_semi_logo']);
            $semi['fourth_semi'] = @$quart1[0];
            $semi['fourth_semi_logo'] = @$quart1[1];
        }
        if ($this->input->post('first_fin_logo')) {
            $fin['first_fin_logo'] = $this->input->post('first_fin_logo');
        } else {
            @$quart1 = explode('$$', $fin['first_fin_logo']);
            $fin['first_fin'] = @$quart1[0];
            $fin['first_fin_logo'] = @$quart1[1];
        }
        if ($this->input->post('second_fin_logo')) {
            $fin['second_fin_logo'] = $this->input->post('second_fin_logo');
        } else {
            @$quart1 = explode('$$', $fin['second_fin_logo']);
            $fin['second_fin'] = @$quart1[0];
            $fin['second_fin_logo'] = @$quart1[1];
        }
        if ($this->input->post('first_vin_logo')) {
            $vin['first_vin_logo'] = $this->input->post('first_vin_logo');
        } else {
            @$quart1 = explode('$$', $fin['first_fin_logo']);
            $vin['first_vin'] = @$quart1[0];
            $vin['first_vin_logo'] = @$quart1[1];
        }