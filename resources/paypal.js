paypal
    .Buttons({

        style: {
            layout: 'vertical',
            color: 'gold',
            shape: 'pill',
            label: 'pay',
            disableMaxWidth: true
        },
        // Order is created on the server and the order id is returned
        createOrder() {
            return fetch("/paypal/backend_php/create-paypal-order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                }
            }).then((response) => response.json())
                .then((order) => order.id);
        },
        onApprove(data) {
            return fetch("/paypal/backend_php/check-paypal-order.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    orderID: data.orderID
                })
            })
                .then((response) => response.json())
                .then((orderData) => {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result\n\n', orderData, JSON.stringify(orderData, ','));
                    const ord = JSON.parse(orderData);
                    const orderID = ord.id;
                    const intent = ord.intent;
                    const status = ord.status;
                    alert(`Order id is ${orderID}\n Intent : ${intent}\n Current status : ${status}\n\nPRESS CAPTURE BUTTON ON NEXT SCREEN TO COMPLETE THE CAPTURE!!!`);
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    window.location.href = '/paypal/backend_php/thankyou.php?orderID=' + orderID;
                });
        }
    }).render('#paypal-button-container');
