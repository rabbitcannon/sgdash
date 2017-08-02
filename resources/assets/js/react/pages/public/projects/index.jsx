import React from "react";
import ReactDOM from "react-dom";

import Results from './components/results.jsx';
// import ResultsFilter from './components/result-filter.jsx';

const Projects = () => {
    return (
        <Results />
    );
}
ReactDOM.render(<Projects />, document.getElementById("project-list"));
