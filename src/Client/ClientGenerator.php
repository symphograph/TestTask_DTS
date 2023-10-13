<?php

namespace App\Client;

class ClientGenerator extends Client
{
    private const maleNames = [
        "Иван",
        "Петр",
        "Александр",
        "Дмитрий",
        "Сергей",
        "Михаил",
        "Андрей",
        "Алексей",
        "Владимир",
        "Николай",
        "Георгий",
        "Максим",
        "Артем",
        "Денис",
        "Антон",
        "Егор",
        "Кирилл",
        "Игорь",
        "Федор",
        "Тимофей",
        "Роман",
        "Олег",
        "Станислав",
        "Василий",
        "Виктор",
        "Арсений",
        "Валентин",
        "Павел",
        "Григорий",
        "Вячеслав",
        "Савелий",
        "Ярослав",
        "Валерий",
        "Анатолий",
        "Семен",
        "Евгений",
        "Никита",
        "Савва",
        "Филипп",
        "Вениамин",
        "Виталий",
        "Ростислав",
        "Марк",
        "Святослав",
        "Даниил",
        "Леонид",
        "Ефим",
        "Герман",
        "Матвей",
        "Тихон",
        "Аркадий",
        "Варфоломей",
        "Марат",
        "Тарас",
        "Мирослав",
        "Трофим",
        "Емельян",
        "Юрий",
        "Илья",
        "Вениамин",
        "Захар",
        "Игнат",
        "Родион",
        "Филимон",
        "Гордей",
        "Тимур",
        "Валерий",
        "Савелий",
        "Семен",
        "Федот",
        "Геннадий",
        "Валентин",
        "Мирон",
        "Арсен",
        "Милан",
        "Руслан",
        "Исаак",
        "Эльдар",
        "Валериан",
        "Леон",
        "Борис",
        "Лев",
        "Адам",
        "Тихон",
        "Зенон",
        "Дамир",
        "Клим",
        "Артур",
        "Эдуард",
        "Витольд",
        "Людвиг",
        "Эльмар",
        "Юхим",
        "Мирза",
        "Тристан",
    ];

    private const femaleNames = [
        "Анна",
        "Мария",
        "Екатерина",
        "София",
        "Виктория",
        "Алиса",
        "Анастасия",
        "Дарья",
        "Ксения",
        "Валентина",
        "Ольга",
        "Елена",
        "Ирина",
        "Наталья",
        "Алла",
        "Людмила",
        "Инна",
        "Татьяна",
        "Ева",
        "Марина",
        "Вера",
        "Юлия",
        "Лариса",
        "Надежда",
        "Елизавета",
        "Лидия",
        "Тамара",
        "Анжела",
        "Лилия",
        "Светлана",
        "Алёна",
        "Милана",
        "Роза",
        "Майя",
        "Инга",
        "Жанна",
        "Лариса",
        "Раиса",
        "Розалия",
        "Яна",
        "Галина",
        "Виолетта",
        "Эльза",
        "Иветта",
        "Руфина",
        "Эмилия",
        "Зарина",
        "Регина",
        "Салима",
        "Анжелла",
        "Гузель",
        "Радмила",
        "Альфия",
        "Элла",
        "Сильва",
        "Лариса",
        "Анюта",
        "Юлия",
        "Роза",
        "Дина",
        "Юзефа",
        "Магдалина",
        "Амелия",
        "Варвара",
        "Злата",
        "Регина",
        "Антонина",
        "Инесса",
        "Вероника",
        "Эльмира",
        "Луиза",
        "Доминика",
        "Сусанна",
        "Венера",
        "Рада",
        "Розалия",
        "Валерия",
        "Снежана",
        "Майя",
        "Талия",
        "Сандра",
        "Лилия",
        "Альбина",
        "Гульназ",
        "Розита",
        "Гульчачак",
        "Гаяна",
        "Наталия",
        "Лидия",
        "Ирма",
        "Фатима",
        "Нона",
        "Милена",
    ];

    private const maleSurnames = [
        "Иванов",
        "Смирнов",
        "Кузнецов",
        "Попов",
        "Лебедев",
        "Козлов",
        "Новиков",
        "Морозов",
        "Петров",
        "Волков",
        "Соловьев",
        "Васильев",
        "Зайцев",
        "Павлов",
        "Семенов",
        "Голубев",
        "Виноградов",
        "Борисов",
        "Комаров",
        "Егоров",
        "Королев",
        "Гусев",
        "Ширяев",
        "Баранов",
        "Левин",
        "Макаров",
        "Андреев",
        "Левашов",
        "Беляков",
        "Белов",
        "Суханов",
        "Казаков",
        "Тимофеев",
        "Соколов",
        "Кулагин",
        "Архипов",
        "Анисимов",
        "Лапин",
        "Барсуков",
        "Зуев",
        "Сорокин",
        "Миронов",
        "Федоров",
        "Устинов",
        "Воронин",
        "Шестаков",
        "Зверев",
        "Кулаков",
        "Марков",
        "Чернов",
        "Захаров",
        "Лобанов",
        "Симонов",
        "Михайлов",
        "Филиппов",
        "Киселев",
        "Федотов",
        "Трофимов",
        "Поляков",
        "Шилов",
        "Степанов",
        "Власов",
        "Селезнев",
        "Носков",
        "Беляев",
        "Дорофеев",
        "Галкин",
        "Титов",
        "Корнеев",
        "Беспалов",
        "Филатов",
        "Комиссаров",
        "Гребенщиков",
        "Костин",
        "Рогов",
        "Селезнев",
        "Кондратьев",
        "Котов",
        "Горбунов",
        "Кудрявцев",
        "Бородин",
        "Андреев",
        "Куприянов",
        "Поликарпов",
        "Макеев",
        "Ларин",
        "Исаков",
        "Игнатьев",
        "Малахов",
        "Сафонов",
        "Лукьянов",
        "Тихонов",
        "Дьячков",
        "Данилов",
        "Мельников",
        "Максимов",
        "Лазарев",
        "Сергеев",
        "Стрелков",
        "Степанов",
        "Бородин",
        "Быков",
        "Мартынов",
    ];

    private const femaleSurnames = [
        "Иванова",
        "Смирнова",
        "Кузнецова",
        "Попова",
        "Лебедева",
        "Козлова",
        "Новикова",
        "Морозова",
        "Петрова",
        "Волкова",
        "Соловьева",
        "Васильева",
        "Зайцева",
        "Павлова",
        "Семенова",
        "Голубева",
        "Виноградова",
        "Борисова",
        "Комарова",
        "Егорова",
        "Королева",
        "Гусева",
        "Ширяева",
        "Баранова",
        "Левина",
        "Макарова",
        "Андреева",
        "Левашова",
        "Белякова",
        "Белова",
        "Суханова",
        "Казакова",
        "Тимофеева",
        "Соколова",
        "Кулагина",
        "Архипова",
        "Анисимова",
        "Лапина",
        "Барсукова",
        "Зуева",
        "Сорокина",
        "Миронова",
        "Федорова",
        "Устинова",
        "Воронина",
        "Шестакова",
        "Зверева",
        "Кулакова",
        "Маркова",
        "Чернова",
        "Захарова",
        "Лобанова",
        "Симонова",
        "Михайлова",
        "Филиппова",
        "Киселева",
        "Федотова",
        "Трофимова",
        "Полякова",
        "Шилова",
        "Степанова",
        "Власова",
        "Селезнева",
        "Носкова",
        "Беляева",
        "Дорофеева",
        "Галкина",
        "Титова",
        "Корнеева",
        "Беспалова",
        "Филатова",
        "Комиссарова",
        "Гребенщикова",
        "Костина",
        "Рогова",
        "Селезнева",
        "Кондратьева",
        "Котова",
        "Горбунова",
        "Кудрявцева",
        "Бородина",
        "Андреева",
        "Куприянова",
        "Поликарпова",
        "Макеева",
        "Ларина",
        "Исакова",
        "Игнатьева",
        "Малахова",
        "Сафонова",
        "Лукьянова",
        "Тихонова",
        "Дьячкова",
        "Данилова",
        "Мельникова",
        "Максимова",
        "Лазарева",
        "Сергеева",
        "Стрелкова",
        "Степанова",
        "Бородина",
        "Быкова",
        "Мартынова",
        ];


    public function __construct(int $i)
    {
        $this->id = $i;
        $this->name = self::generateFullName();
    }

    public static function create(int $i): parent
    {
        $data = new self($i);
        return Client::byBind($data);
    }

    private static function generateFullName(): string
    {
        $gender = rand(0, 1); // 0 - мужской, 1 - женский
        $firstName = $gender === 0
            ? self::maleNames[array_rand(self::maleNames)]
            : self::femaleNames[array_rand(self::femaleNames)];

        $lastName = $gender === 0
            ? self::maleSurnames[array_rand(self::maleSurnames)]
            : self::femaleSurnames[array_rand(self::femaleSurnames)];

        return "$firstName $lastName";
    }
}