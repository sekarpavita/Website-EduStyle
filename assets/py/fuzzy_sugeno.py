from flask import Flask, request, jsonify, render_template
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

def rendah(x):
    if x <= 13:
        return 1.0
    elif 13 < x <= 24:
        return (25 - x) / 12
    else:
        return 0.0

def sedang(x):
    if 13 < x <= 25:
        return (x - 13) / 12
    elif 25 < x <= 36:
        return (37 - x) / 12
    else:
        return 0.0

def tinggi(x):
    if x >= 37:
        return 1.0
    elif 25 < x < 37:
        return (x - 25) / 12
    else:
        return 0.0

def sugeno_defuzzification(visual_mf, auditori_mf, kinestetik_mf):
    rules = [
        {'v': 'tinggi', 'a': 'rendah', 'k': 'rendah', 'output': {'visual': 100, 'auditori': 30, 'kinestetik': 30}},
        {'v': 'tinggi', 'a': 'rendah', 'k': 'sedang', 'output': {'visual': 100, 'auditori': 30, 'kinestetik': 60}},
        {'v': 'tinggi', 'a': 'sedang', 'k': 'rendah', 'output': {'visual': 100, 'auditori': 60, 'kinestetik': 30}},
        {'v': 'tinggi', 'a': 'sedang', 'k': 'sedang', 'output': {'visual': 100, 'auditori': 60, 'kinestetik': 60}},
        {'v': 'tinggi', 'a': 'rendah', 'k': 'tinggi', 'output': {'visual': 100, 'auditori': 30, 'kinestetik': 100}},
        {'v': 'tinggi', 'a': 'sedang', 'k': 'tinggi', 'output': {'visual': 100, 'auditori': 60, 'kinestetik': 100}},
        {'v': 'tinggi', 'a': 'tinggi', 'k': 'rendah', 'output': {'visual': 100, 'auditori': 100, 'kinestetik': 30}},
        {'v': 'tinggi', 'a': 'tinggi', 'k': 'sedang', 'output': {'visual': 100, 'auditori': 100, 'kinestetik': 60}},
        {'v': 'tinggi', 'a': 'tinggi', 'k': 'tinggi', 'output': {'visual': 100, 'auditori': 100, 'kinestetik': 100}},
        {'v': 'rendah', 'a': 'rendah', 'k': 'rendah', 'output': {'visual': 30, 'auditori': 30, 'kinestetik': 30}},
        {'v': 'rendah', 'a': 'rendah', 'k': 'sedang', 'output': {'visual': 30, 'auditori': 30, 'kinestetik': 60}},
        {'v': 'rendah', 'a': 'rendah', 'k': 'tinggi', 'output': {'visual': 30, 'auditori': 30, 'kinestetik': 100}},
        {'v': 'rendah', 'a': 'sedang', 'k': 'tinggi', 'output': {'visual': 30, 'auditori': 60, 'kinestetik': 100}},
        {'v': 'rendah', 'a': 'sedang', 'k': 'sedang', 'output': {'visual': 30, 'auditori': 60, 'kinestetik': 60}},
        {'v': 'rendah', 'a': 'tinggi', 'k': 'tinggi', 'output': {'visual': 30, 'auditori': 100, 'kinestetik': 100}},
        {'v': 'rendah', 'a': 'tinggi', 'k': 'sedang', 'output': {'visual': 30, 'auditori': 100, 'kinestetik': 60}},
        {'v': 'rendah', 'a': 'sedang', 'k': 'rendah', 'output': {'visual': 30, 'auditori': 60, 'kinestetik': 30}},
        {'v': 'rendah', 'a': 'tinggi', 'k': 'rendah', 'output': {'visual': 30, 'auditori': 100, 'kinestetik': 30}},
        {'v': 'sedang', 'a': 'sedang', 'k': 'sedang', 'output': {'visual': 60, 'auditori': 60, 'kinestetik': 60}},
        {'v': 'sedang', 'a': 'sedang', 'k': 'rendah', 'output': {'visual': 60, 'auditori': 60, 'kinestetik': 30}},
        {'v': 'sedang', 'a': 'sedang', 'k': 'tinggi', 'output': {'visual': 60, 'auditori': 60, 'kinestetik': 100}},
        {'v': 'sedang', 'a': 'rendah', 'k': 'rendah', 'output': {'visual': 60, 'auditori': 30, 'kinestetik': 30}},
        {'v': 'sedang', 'a': 'rendah', 'k': 'tinggi', 'output': {'visual': 60, 'auditori': 30, 'kinestetik': 100}},
        {'v': 'sedang', 'a': 'tinggi', 'k': 'tinggi', 'output': {'visual': 60, 'auditori': 100, 'kinestetik': 100}},
        {'v': 'sedang', 'a': 'rendah', 'k': 'sedang', 'output': {'visual': 60, 'auditori': 30, 'kinestetik': 60}},
        {'v': 'sedang', 'a': 'tinggi', 'k': 'sedang', 'output': {'visual': 60, 'auditori': 100, 'kinestetik': 60}},
        {'v': 'sedang', 'a': 'tinggi', 'k': 'rendah', 'output': {'visual': 60, 'auditori': 100, 'kinestetik': 30}},
    ]

    total_visual_fuzzified = 0
    total_auditori_fuzzified = 0
    total_kinestetik_fuzzified = 0
    sum_of_weights = 0

    for rule in rules:
        v_level = rule['v']
        a_level = rule['a']
        k_level = rule['k']

        mv_v = 0
        if v_level == 'rendah':
            mv_v = rendah(visual_mf)
        elif v_level == 'sedang':
            mv_v = sedang(visual_mf)
        elif v_level == 'tinggi':
            mv_v = tinggi(visual_mf)

        mv_a = 0
        if a_level == 'rendah':
            mv_a = rendah(auditori_mf)
        elif a_level == 'sedang':
            mv_a = sedang(auditori_mf)
        elif a_level == 'tinggi':
            mv_a = tinggi(auditori_mf)

        mv_k = 0
        if k_level == 'rendah':
            mv_k = rendah(kinestetik_mf)
        elif k_level == 'sedang':
            mv_k = sedang(kinestetik_mf)
        elif k_level == 'tinggi':
            mv_k = tinggi(kinestetik_mf)

        alpha = min(mv_v, mv_a, mv_k)

        if alpha > 0:
            total_visual_fuzzified += alpha * rule['output']['visual']
            total_auditori_fuzzified += alpha * rule['output']['auditori']
            total_kinestetik_fuzzified += alpha * rule['output']['kinestetik']
            sum_of_weights += alpha

    if sum_of_weights == 0:
        return {'visual': 0, 'auditori': 0, 'kinestetik': 0}

    result_visual_raw = total_visual_fuzzified / sum_of_weights
    result_auditori_raw = total_auditori_fuzzified / sum_of_weights
    result_kinestetik_raw = total_kinestetik_fuzzified / sum_of_weights

    total_raw_sum = result_visual_raw + result_auditori_raw + result_kinestetik_raw

    if total_raw_sum == 0:
        return {'visual': 0, 'auditori': 0, 'kinestetik': 0}

    percentage_visual = (result_visual_raw / total_raw_sum) * 100
    percentage_auditori = (result_auditori_raw / total_raw_sum) * 100
    percentage_kinestetik = (result_kinestetik_raw / total_raw_sum) * 100

    return {
        'visual': round(percentage_visual, 2),
        'auditori': round(percentage_auditori, 2),
        'kinestetik': round(percentage_kinestetik, 2)
    }

@app.route('/')
def index():
    return render_template('index.php')

@app.route('/calculate_learning_style', methods=['POST'])
def calculate_learning_style():
    data = request.get_json()
    total_v = data.get('total_v', 0)
    total_a = data.get('total_a', 0)
    total_k = data.get('total_k', 0)

    total_v = max(0, min(100, total_v))
    total_a = max(0, min(100, total_a))
    total_k = max(0, min(100, total_k))

    results = sugeno_defuzzification(total_v, total_a, total_k)
    return jsonify(results)

if __name__ == '__main__':
    app.run(debug=True, host='127.0.0.1', port=5000)