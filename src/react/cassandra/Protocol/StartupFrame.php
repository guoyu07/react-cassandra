<?php
namespace Tatikoma\React\Cassandra\Protocol;

class StartupFrame extends AbstractFrame
{
    /**
     * @var string the version of CQL to use.
     */
    public $cql_version = '3.0.0';
    /**
     * @var string he compression algorithm to use for frames
     */
    public $compression = null;

    public function fromBytes($bytes = "")
    {
        throw new \Tatikoma\React\Cassandra\Exception('Not implemented yet');
    }

    public function fromParams($params = [])
    {
        $this->opcode = \Tatikoma\React\Cassandra\Constants::OPCODE_STARTUP;
        if (isset($params['cql_version'])) {
            $this->cql_version = $params['cql_version'];
        }
        if (isset($params['compression'])) {
            $this->compression = $params['compression'];
        }
        parent::fromParams($params);
    }

    public function toBytes()
    {
        $params['CQL_VERSION'] = $this->cql_version;
        if (!is_null($this->compression)) {
            $params['COMPRESSION'] = $this->compression;
        }
        $packet = FrameHelper::writeStringMap($params);
        $packet = parent::writeHeader($packet);

        return $packet;
    }
}