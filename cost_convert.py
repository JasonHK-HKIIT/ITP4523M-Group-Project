from flask import Flask
from werkzeug.exceptions import BadRequest

CURRENCIES = ("EUR", "HKD", "JPY")

app = Flask(__name__)

@app.route("/cost_convert/<amount>/<currency>/<rate>", methods=["GET"])
def convert_currencies(amount: str, currency: str, rate: str):
    if not currency in CURRENCIES:
        return { "result": "rejected", "reason": f"currency must be one of: {", ".join(CURRENCIES)}" }, 400
    
    try:
        if float(amount) < 0:
            return { "result": "rejected", "reason": "amount must be a positive number" }, 400
        if float(rate) < 0:
            return { "result": "rejected", "reason": "rate must be a positive number" }, 400
    except ValueError:
        return { "result": "rejected", "reason": "amount and rate must be a number" }, 400
    
    return { "result": "accepted", "converted_amount": float(amount) * float(rate) }
