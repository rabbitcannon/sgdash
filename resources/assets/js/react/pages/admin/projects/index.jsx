import "babel-polyfill";
import React from "react";
import ReactDOM from "react-dom";

import Results from './components/results.jsx';

export default class Projects extends React.Component {

    render() {
        return (
            <Results />
        );
    }
}

ReactDOM.render(<Projects />, document.getElementById("project-list"));