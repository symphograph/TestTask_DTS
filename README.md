# Тестовое задание

<details style="cursor: pointer">
<summary>Описание задания</summary>

Есть база данных для хранения информации о клиентах, товарах и заказах со
следующей структурой:
clients (id, name) - ID клиента и его имя
merchandise (id, name) - ID товара и его наименование
orders (id, item_id, customer_id, comment, status, order_date) - ID заказа, ID товара, ID
клиента, комментарий клиента, статус заказа (‘new’, ‘complete’), дата заказа (то есть
структура предполагает, что один заказ - это один товар)

Необходимо:
1. Написать скрипт, который получает на вход текстовый файл с данными о
   заказах (разделитель “;”) вида: ID товара;ID клиента;Комментарий к заказу и
   загружает содержимое в описанную выше структуру БД, при этом все
   невалидные строки должны записываться в отдельный файл. Использование
   сторонних решений / библиотек нежелательно.


2. Написать SQL запросы, возвращающие набор данных, соответствующий
   следующим условиям:
   - a. Выбрать имена (name) всех клиентов, которые не делали заказы в последние
   7 дней.
   - b. Выбрать имена (name) 5 клиентов, которые сделали больше всего заказов в
   - магазине.
   - c. Выбрать имена (name) 10 клиентов, которые сделали заказы на наибольшую
   сумму.
   - d. Выбрать имена (name) всех товаров, по которым не было доставленных
   заказов (со статусом “complete”).


3. Описать, какие бы вы создали индексы для оптимизации скорости работы
   запросов из п.2 и почему
</details>

---
# Результат

Создание таблиц:
```sql
CREATE TABLE merchandise (
    id INT NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
)
```

```sql
CREATE TABLE clients (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)
```

```sql
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    customer_id INT NOT NULL,
    comment TEXT NOT NULL,
    status VARCHAR(10) NOT NULL,
    order_date DATE NOT NULL,
    INDEX idx_status (status),
    INDEX idx_order_date (order_date),
    FOREIGN KEY (item_id) REFERENCES merchandise(id),
    FOREIGN KEY (customer_id) REFERENCES clients(id)
)
```
Поскольку при создании FOREIGN KEY индексы создаются автоматически, 
остаётся упомянуть лишь про индексы для orders.status и orders.order_date.
Индексы для этих полей могут способствовать более быстрой выборке, поскольку используются в нижеизложенных запросах.
#### Запросы:

Выбрать всех клиентов, которые не делали заказы в последние 7 дней
```sql
SELECT
    c.id,
    c.NAME 
FROM
    clients c
    LEFT JOIN orders o 
        ON c.id = o.customer_id 
WHERE
    o.order_date IS NULL 
    OR o.order_date <= NOW() - INTERVAL 7 DAY
GROUP BY c.id
```

Выбрать 5 клиентов, которые сделали больше всего заказов в магазине
```sql
SELECT 
    c.id, 
    c.name
FROM 
    clients c
LEFT JOIN orders o 
    ON c.id = o.customer_id
GROUP BY c.id
ORDER BY COUNT(o.id) DESC
LIMIT 5
```
Выбрать 10 клиентов, которые сделали заказы на наибольшую сумму
```sql
SELECT
    c.id,
    c.name
FROM
    clients c
LEFT JOIN
    orders o 
        ON c.id = o.customer_id
LEFT JOIN
    merchandise m 
        ON o.item_id = m.id
GROUP BY
    c.id, c.name
HAVING
    SUM(m.price) > 0
ORDER BY
    SUM(m.price) DESC
LIMIT 10
```
Выбрать все товары, по которым не было доставленных заказов
```sql
SELECT
    m.id,
    m.name
FROM
    merchandise m
LEFT JOIN
    orders o 
        ON m.id = o.item_id
WHERE
    o.id IS NULL OR o.status != 'complete'
GROUP BY m.id, m.name
```
<small>Вероятно, что для практического применения потребуется изменить критерий этого запроса, поскольку в текущем виде его выполнение может потребовать избыточное количество ресурсов, особенно при большом количестве товаров в бд.</small>

---

## Код для тестов:

### Загрузите репозиторий
```bash
git clone --depth=1 --branch=master https://github.com/ .
```

### Установите зависимости
```bash
composer install -d
```


- Откройте файл 
```
tests/App/Order/OrderListTest.php
```
- Запустите OrderListTest (Ctrl + Shift + F10)

В результате выполнения будут созданы таблицы и файл /tmp/orders.txt, заполненные тестовыми данными.

Методы, содержащие запросы, находятся в файле
```
src/Queries.php
```
Пример использования:
```php
App\Order\OrderList::byFile(); // Импорт заказов из файла
App\Queries::listTopClients(5); // Вернёт массив с объектами класса App\Client\Client
```