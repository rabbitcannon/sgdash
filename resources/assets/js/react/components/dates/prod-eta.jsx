import React, {Component} from "react";
import ReactDOM from "react-dom";
import ReactDatePicker from 'react-datepicker';

class ProdEta extends React.Component {
	constructor(props) {
		super(props);

		this.state = {
			selected_date: ''
		}
	}

	handleChange = (date) => {
		this.setState({
			selected_date: date
		})
	}

	render() {
		return (
			<ReactDatePicker
				name="prod_eta"
				placeholderText="Date"
				showMonthDropdown
				showYearDropdown
				selected={this.state.selected_date}
				yearDropdownItemNumber={5}
				shouldCloseOnSelect={true}
				onChange={this.handleChange}
			/>
		);
	}
}

ReactDOM.render(<ProdEta/>, document.getElementById("add-prod-eta"));