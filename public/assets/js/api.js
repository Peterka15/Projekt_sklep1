// function updateButton(produkty){
//     produkty.map(produkt => console.log(`${produkt.id}, zamówiono ${produkt.ilosc} sztuk`));
// }

function getCart(userId, callbackFn = () => {}){
    fetch(`http://localhost/Projekt_sklep1/public/cartGet?id=${userId}`, {
        method: 'GET',
    })
        .then(response => response.json())
        .then(data => {
            console.log('Otrzymano  (GET): ', data);
            return data;
        })
        .then(data => callbackFn(data));
}

function postCart(userId, cart, callbackFn = () => {}, full = false){
    let url = `http://localhost/Projekt_sklep1/public/cartPost?id=${userId}`;

    if(full){
        url += '&full=1';
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: JSON.stringify(cart)
    })
        .then(response => response.json())
        .then(data => {
            console.log('Otrzymano (POST): ', data);
            return data;
        })
        .then(data => callbackFn(data));
}