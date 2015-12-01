<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 27/11/15
 * Time: 11:07
 */

namespace PS\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use PS\Transformers\ProjectTransformer;

class ProjectPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}