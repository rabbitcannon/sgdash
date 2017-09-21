import React, {Component} from "react";
import ReactDOM from "react-dom";

class ResultFilter extends React.Component {
    constructor(props) {
        super(props);
    }

    grabProjects = () => {
        let url = window.location.origin + '/api/v1/projects';
        this.props.getProjects(url);
        console.log('stuff');
    }

    render() {
        return (
            <div>
                Result Filter<br />
                <button className="button" onClick={this.grabProjects.bind(this)}>BUTTON SON!</button>
            </div>
        );
    }
}

export default ResultFilter;