<?php

namespace PS\Presenters;

use CodeProject\Transformers\ProjectFileTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjectFilePresenter
 *
 * @package namespace CodeProject\Presenters;
 */
class ProjectFilePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectFileTransformer();
    }
}