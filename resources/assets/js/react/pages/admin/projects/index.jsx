import React from "react";
import ReactDOM from "react-dom";

import Results from './components/results.jsx';

class Projects extends React.Component {

	render() {
		return (
			<div>
				<Results/>
			</div>
		);
	}
}

ReactDOM.render(<Projects/>, document.getElementById("project-list"));
