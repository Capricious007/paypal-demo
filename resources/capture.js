
const orderspan = document.getElementById('orderid')
const ord = orderspan.textContent
console.log(ord);



function cap(ord) {
    return fetch(
        "/paypal/backend_php/capture-approved-order.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            orderID: ord
        })
    }
    ).then((response) => response.json())
        .then((captureData) => {
            const cdn = JSON.parse(captureData);
            console.log(cdn)
            alert(`Order id is ${cdn.id}\nCurrent status : ${cdn.status}\nPayment Account Id : ${cdn.payment_source.paypal.account_id}`);
            console.log(retry());
            // alert("Data captured!!" + cdnn.name);

        })

}

function retry() {
    const divbtn = document.getElementById('retry')
    const retrybtn = document.createElement('button')
    retrybtn.innerHTML = 'RETRY a new Payment'
    retrybtn.setAttribute("onclick", "window.location.href = '/paypal/pp_index.html'")
    retrybtn.setAttribute("id", "retrybtn")
    divbtn.appendChild(retrybtn)
    return ("Button created")
}