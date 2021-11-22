<?php
declare(strict_types=1);

namespace YuliiaK\Install\Command;

use YuliiaK\Blog\Model\Category\Repository as CategoryRepository;
use YuliiaK\Blog\Model\Post\Repository as PostRepository;
use YuliiaK\Blog\Model\Author\Repository as AuthorRepository;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateData extends \Symfony\Component\Console\Command\Command
{
    protected static $defaultName = 'install:generate-data';

    private \YuliiaK\Framework\Database\Adapter\AdapterInterface $adapter;

    private OutputInterface $output;

    private const AUTHORS_COUNTER = 20;

    private int $postsCounter = 0;

    /**
     * @param \YuliiaK\Framework\Database\Adapter\AdapterInterface $adapter
     * @param string|null $name
     */
    public function __construct(
        \YuliiaK\Framework\Database\Adapter\AdapterInterface $adapter,
        string $name = null
    ) {
        parent::__construct($name);
        $this->adapter = $adapter;
    }


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Generate demo data for shop testing');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->output = $output;
        $this->generateData();
        $output->writeln('Completed!');

        return self::SUCCESS;
    }

    /**
     * Generate test data
     *
     * @return void
     */
    private function generateData(): void
    {
        $this->profile([$this, 'truncateTables']);
        $this->profile([$this, 'generateCategories']);
        $this->profile([$this, 'generateAuthors']);
        $this->profile([$this, 'generatePosts']);
        $this->profile([$this, 'generatePostCategories']);
        $this->profile([$this, 'generateStatistics']);
    }

    /**
     * Truncate (empty) tables before inserting new data
     *
     * @return void
     */
    private function truncateTables(): void
    {
        $tables = [
            PostRepository::TABLE_CATEGORY_POST,
            PostRepository::TABLE_STATISTICS,
            CategoryRepository::TABLE,
            PostRepository::TABLE,
            AuthorRepository::TABLE,
        ];
        $connection = $this->adapter->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($tables as $table) {
            $connection->query("TRUNCATE TABLE `$table`");
            $this->output->writeln("Truncated table: $table");
        }

        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Insert seven categories. Add data to random 5 of them
     *
     * @return void
     */
    private function generateCategories(): void
    {
        $categories = [
            'Science', 'Sport', 'Economy', 'Politics', 'Culture', 'Animals', 'Technologies', 'Trips', 'Hobby', 'Other'
        ];
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO category (`name`, `url`)
                VALUES (:name, :url);
            SQL);
        foreach ($categories as $category) {
            $statement->bindValue(':name', $category);
            $statement->bindValue(':url', strtolower($category));
            $statement->execute();
        }
    }

    /**
     * @return void
     */
    private function generateAuthors(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO author (`name`, `surname`, `url`)
                VALUES (:name, :surname, :url);
            SQL);
        for ($i = 1; $i <= self::AUTHORS_COUNTER; $i++) {
            $name = "Name $i";
            $surname_num = random_int(1, 7);
            $surname = "Surname $surname_num";
            $statement->bindValue(':name', $name);
            $statement->bindValue(':surname', $surname);
            $statement->bindValue(':url', str_replace(' ', '-', strtolower($name)));
            $statement->execute();
        }
    }

    /**
     * @return void
     */
    private function generatePosts(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO post (`name`, `url`, `description`, `author_id`)
                VALUES (:name, :url, :description, :author_id);
            SQL);

        for ($k = 1; $k <= self::AUTHORS_COUNTER; $k++) {
            $counter = random_int(5, 20);
            for ($i = 1; $i <= $counter; $i++) {
                $name = "Post $k$i";
                $url = str_replace(' ', '_', strtolower($name));
                $statement->bindValue(':name', $name);
                $statement->bindValue(':url', $url);
                $statement->bindValue(':description', "$name Description $k$i");
                $statement->bindValue(':author_id', $k);
                $statement->execute();

                $this->postsCounter++;
            }
        }
    }

    /**
     * @return void
     */
    private function generatePostCategories(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO category_post (`category_id`, `post_id`)
                VALUES (:category_id, :post_id);
            SQL);

        // Get only 7 random categories of total 10
        $categoryIds = array_rand(array_flip(range(1, 10)), 7);

        for ($i = 1; $i <= $this->postsCounter; $i++) {
            $postCategories = (array) array_rand(array_flip($categoryIds), random_int(1, 3));

            foreach ($postCategories as $categoryId) {
                $statement->bindValue(':category_id', $categoryId);
                $statement->bindValue(':post_id', $i);
                $statement->execute();
            }
        }
    }

    /**
     * @return void
     */
    private function generateStatistics(): void
    {
        $statement = $this->adapter->getConnection()
            ->prepare(<<<SQL
                INSERT INTO `statistics` (`number_views`, `date`, `post_id`)
                VALUES (:number_views, :date, :post_id);
            SQL);

        for ($i = 2; $i >= 1; $i--) {
            for ($k = 1; $k <= $this->postsCounter; $k++) {
                $statement->bindValue(':number_views', random_int(0, 50), \PDO::PARAM_INT);
                $statement->bindValue(':date',  date('Y-m-d'));
                $statement->bindValue(':post_id', $k);
                $statement->execute();
            }
        }
    }

    /**
     * @param callable $callback
     * @return void
     */
    private function profile(callable $callback): void
    {
        $start = microtime(true);
        $callback();
        $totalTime = number_format(microtime(true) - $start, 4);
        $this->output->writeln("Executing <info>$callback[1]</info> took <info>$totalTime</info>");
    }
}
