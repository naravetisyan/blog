import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import {Redirect} from "react-router";


export default class Posts extends Component {
    constructor(props){
        super(props);
        this.state = {
            posts: [],
        };
    }
    componentWillMount(){
        let url = '/api/posts';
        axios.get(url).then((response) => {
            this.setState({
                posts: response.data.posts
            })
        });
    }
    render() {
        let posts = this.state.posts;
        return (
            <div className="posts-all">
                <h3>Posts</h3>
                <div className="list-group">
                {   
                    posts.map((value, index) => {
                        let src = "../images/"+value.image;
                        return (
                            <div key={index}>
                                <div id="mine">
                                    <div className="row">
                                        <div className="span2">
                                            <a href="#" className="thumbnail bg-img">
                                                <img width="260" height="180" src={src}/>
                                            </a>
                                        </div>
                                        <div className="span6"> 
                                            <h3>{value.title}</h3>     
                                            <p className="p-1">{value.text}</p>
                                            <p id="p-2">
                                                #Category : {value.category.title}   
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        )   
                    })
                }
                </div>
            </div>
        )
    }
}
