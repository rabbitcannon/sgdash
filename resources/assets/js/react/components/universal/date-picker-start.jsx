import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import ReactDatePicker from 'react-datepicker';
import Moment from 'moment';

export default class DatePickerStart extends React.Component {
    constructor() {
        super();

        this.state = {
            date: ''
            // date: Moment()
        }

		this.handleChange = this.handleChange.bind(this);
    }

    handleChange(new_date) {
		this.setState({
			date: new_date
		});
    }

    render() {
        return (
            <ReactDatePicker
				id="creation-date-start"
				name="creation-date-start"
                selected={this.state.date}
                onChange={this.handleChange}
            />
        );
    }
}

ReactDOM.render(<DatePickerStart />, document.getElementById("date-picker-start"));