import React from "react";
import ReactDOM from "react-dom";

import Results from './components/results.jsx';
// import ResultsFilter from './components/results-filter.jsx';

const Users = () => {
	return (
        <Results />
	);
}

ReactDOM.render(<Users />, document.getElementById("users-list"));