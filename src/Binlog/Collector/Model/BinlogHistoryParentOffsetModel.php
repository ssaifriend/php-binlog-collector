<?php

namespace Binlog\Collector\Model;

use Binlog\Collector\Dto\OnlyBinlogOffsetDto;

/**
 * Class BinlogHistoryParentOffsetModel
 * @package Binlog\Collector\Model
 */
class BinlogHistoryParentOffsetModel extends BinlogHistoryBaseModel
{
    const CURRENT_OFFSET = 0;

    public function getParentBinlogOffset(): OnlyBinlogOffsetDto
    {
        $dict = $this->db->sqlDict(
            'SELECT * FROM platform_universal_history_offset WHERE ?',
            sqlWhere(['offset_type' => self::CURRENT_OFFSET])
        );

        return OnlyBinlogOffsetDto::importOnlyBinlogOffset(
            $dict['end_bin_log_file_name'],
            $dict['end_bin_log_position'],
            $dict['end_bin_log_date']
        );
    }

    /**
     * @return string|null
     */
    public function getParentBinlogDate()
    {
        return $this->db->sqlData(
            'SELECT end_bin_log_date FROM platform_universal_history_offset WHERE ?',
            sqlWhere(['offset_type' => self::CURRENT_OFFSET])
        );
    }

    public function upsertParentBinlogOffset(OnlyBinlogOffsetDto $binlog_offset_dto, string $binlog_date = null): int
    {
        $datas = [
            'end_bin_log_file_name' => $binlog_offset_dto->file_name,
            'end_bin_log_position' => $binlog_offset_dto->position,
            'end_bin_log_date' => $binlog_date,
        ];

        return $this->db->sqlInsertOrUpdate('platform_universal_history_offset', $datas);
    }
}
