import React, {Component} from "react";

const url = '/admin/search/projects';
// const url = '/api/v1/projects';

class ResultFilter extends React.Component {
    constructor(props) {
        super(props);
    }

    render () {
        return (
            <form method="post" onSubmit={this.props.updateProjects.bind(this, url)}>
                <input type="submit" className="button" value="BUTTON SON!" />
            </form>
        );
    }
}

export default ResultFilter;