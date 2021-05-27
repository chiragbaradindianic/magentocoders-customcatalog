<?php
/**
 * MagentoCoders
 * Copyright (C) 2021 MagentoCoders <info@magentocoders.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MagentoCoders
 * @package     MagentoCoders_CustomCatalog
 * @copyright   Copyright (C) 2021 MagentoCoders (http://www.magentocoders.com/)
 * @license     http://www.magentocoders.com/license-agreement.html
 * @author      MagentoCoders <info@magentocoders.com>
 */

namespace MagentoCoders\CustomCatalog\Controller\Adminhtml\Product;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

/**
 * Class Delete
 * @package MagentoCoders\CustomCatalog\Controller\Adminhtml\Product
 */
class Delete extends Action
{
    /**
     * @var \MagentoCoders\CustomCatalog\Model\ProductFactory
     */
    private $productModel;


    /**
     * Delete constructor.
     * @param Context $context
     * @param \MagentoCoders\CustomCatalog\Model\Product $ProductModel
     */
    public function __construct(
        Context $context,
        \MagentoCoders\CustomCatalog\Model\ProductFactory $productModel
    ) {
        parent::__construct($context);
        $this->productModel = $productModel;
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('product_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->productModel->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Product deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['product_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Product does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}
