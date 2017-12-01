import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import {Redirect} from "react-router";

export default class Categories extends Component {
    constructor(props){
        super(props);
        this.state = {
            categories: []
        };
    }
    componentWillReceiveProps(nextProps){
        let categories = this.state.categories;
        if(nextProps.edited_category !== this.props.edited_category){
            categories.map((value, index) => {
                if(value.id == nextProps.edited_category.id){
                    value.title = nextProps.edited_category.title
                }
            })
            this.setState({categories});
        }
        if(nextProps.added_category !== this.props.added_category){
            categories.push(nextProps.added_category);
            this.setState({categories}); 
       }
        if(nextProps.deleted_category !== this.props.deleted_category){
            categories.map((value,index) => {
                if(value.id == nextProps.deleted_category){
                    categories.splice(index,1);
                }
            })
            this.setState({categories});
        }
    }
    componentWillMount() {
        let url = '/api/categories';
        axios.get(url).then((response) => {
            this.setState({
                categories: response.data.categories
            })
        });
    }
    render() {
        return (
            <div className="cat-all">
                <h3>Categories</h3>
                <div className="list-group">
                    {   
                        this.state.categories.map((value, index) => {
                            return <a className = "list-group-item cat-list" key={index}>{value.title}</a>  })
                    }
                </div>
            </div>
        )
    }
}