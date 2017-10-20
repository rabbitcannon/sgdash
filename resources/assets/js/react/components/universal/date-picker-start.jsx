import React, {Component} from 'react';
import ReactDatePicker from 'react-datepicker';

class DatePickerStart extends React.Component {
	constructor() {
		super();

		this.state = {
			date: ''
		}

		this.handleChange = this.handleChange.bind(this);
	}

	componentDidMount = () => {
		// $('#creation-date-start').css('width', '26em');
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
				className="creation-width"
				showMonthDropdown
				showYearDropdown
				placeholderText="End Date"
				selected={this.state.date}
				onChange={this.handleChange}
			/>
		);
	}
}

export default DatePickerStart;