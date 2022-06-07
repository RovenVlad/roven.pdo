# Лабораторная работа №1 & №3

## Техническое задание
Вариант 5. Создать и заполнить произвольными данными БД для хранения информации о товарах в интернет–магазине. Для товара задается название, фирма-производитель, категория товара (процессоры, материнские платы и т.д.), цена товара, количество единиц на складе.

Сформировать запросы и вывести результаты:
- товары выбранного производителя;
- товары выбранной категории;
- товары в выбранном ценовом диапазоне.

## Скрины
![](https://i.imgur.com/tLd4uIY.png)
> Форма без данных
---
![](https://i.imgur.com/2aPkCzL.png)
> Форма с данными
---

## Функция ассинхронного запроса
```javascript
const send = async function(data, text = false) {
    return await fetch('/controllers/controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then((response) => { 
        return text ? response.text() : response.json()
    });
}
```
