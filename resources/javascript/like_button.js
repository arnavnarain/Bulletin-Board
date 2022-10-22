
class HeartButton extends React.Component {
  state = {
    likes: 0
  };

  addLike = () => {
    let newCount = this.state.likes + 1;
     this.setState({
     likes: newCount
     });
  };

  render() {
    const likes = this.state.likes;
    if (likes % 2 == 0) {
      return (
        <div>
          <button
            className="buttonNotPressed"
            onClick={this.addLike}
          >
            <i className="far fa-heart fa-lg" style={{ color: "#33c3f0" }}></i>
          </button>
        </div>
      );
    }
    if (likes %2 != 0) {
      return (
        <div>
          <button className="buttonPressed" onClick={this.addLike}>
            <i className="fas fa-heart fa-lg" style={{ color: "red" }}></i>
          </button>
        </div>
      );
    }
  }
}
    ReactDOM.render(
        <HeartButton />, document.getElementById('root') );