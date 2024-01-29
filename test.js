let count = 0;
let control = true;
// let numbers = [
//     { name: 0, count: 0 },
//     { name: 1, count: 0 },
//     { name: 2, count: 0 },
//     { name: 3, count: 0 },
//     { name: 4, count: 0 },
//     { name: 5, count: 0 },
//     { name: 6, count: 0 },
//     { name: 7, count: 0 },
//     { name: 8, count: 0 },
//     { name: 9, count: 0 }
// ];
let numbers = Array.from({ length: 10 }, (_, i) => ({ name: String(i), count: 0 }));

while (control) {
    count += 1;
    numbers.forEach(number => number.count += 1);

    let countArray = String(count).split('').map(digit => parseInt(digit, 10));

    for (let digit of countArray) {
        let numberObj = numbers.find(number => number.name === String(digit));
        if (numberObj && numberObj.count > 0) {
            numberObj.count -= 1;
        } else {
            control = false;
            break;
        }
    }
}

console.log("count: ", count);
console.log(numbers);
