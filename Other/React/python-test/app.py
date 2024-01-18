from flask import Flask, jsonify, Blueprint

app = Flask(__name__)
api = Blueprint('api', __name__, url_prefix='/projects/python-test/api')

@api.route('/hello')
def hello_world():
    return jsonify(message='Hello, World!')

app.register_blueprint(api)

if __name__ == '__main__':
    app.run(debug=True)
