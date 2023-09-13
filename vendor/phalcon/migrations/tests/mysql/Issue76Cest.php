<?php

/**
 * This file is part of the Phalcon Migrations.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Migrations\Tests\Mysql;

use MysqlTester;
use Phalcon\Db\Exception;
use Phalcon\Migrations\Migrations;

use function codecept_data_dir;

/**
 * @see https://github.com/phalcon/migrations/issues/76
 */
class Issue76Cest
{
    /**
     * @param MysqlTester $I
     * @throws Exception
     */
    public function normalRun(MysqlTester $I): void
    {
        $I->wantToTest('Issue #76 - Normal run with data insert');

        ob_start();
        Migrations::run([
            'migrationsDir' => codecept_data_dir('issues/76'),
            'config' => $I->getMigrationsConfig(),
            'migrationsInDb' => true,
        ]);
        ob_clean();

        $query1 = 'SELECT COUNT(*) cnt FROM user_details WHERE user_id = 62 AND last_name IS NULL';

        $I->assertTrue($I->getPhalconDb()->tableExists('user_details'));
        $I->canSeeNumRecords(2363, 'user_details');
        $I->assertEquals(1, $I->getPhalconDb()->fetchOne($query1)['cnt']);
    }
}
