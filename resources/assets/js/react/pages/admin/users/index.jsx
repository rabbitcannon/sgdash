import React from "react";
import ReactDOM from "react-dom";

import Users from './components/users.jsx';
// import ResultsFilter from './components/result-filter.jsx';

const UsersList = () => {
	return (
        <Users />
	);
}

ReactDOM.render(<UsersList />, document.getElementById("users-list"));